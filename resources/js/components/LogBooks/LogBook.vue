<template>
  <div class="container-fluid px-4">
    <h1 class="mt-4">LogBooks</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><router-link to="/" class="breadcrumb-item active" style="text-decoration: none;">Dashboard</router-link></li>
      <li class="breadcrumb-item active">LogBook</li>
    </ol>
    
    <div class="card mb-4">
      <div class="card-header">
        <router-link to="/logbooks/create" class="btn btn-primary" style="text-decoration: none; color: white;"> <i class="fas fa-plus"></i> Add LogBook</router-link>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Reference Number</th>
              <th scope="col">Name</th>
              <th scope="col">Concern</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(logbook, index) in logbooks.data" :key="logbook.id">
              <td>{{ (logbooks.current_page - 1) * logbooks.per_page + index + 1 }}</td>
              <td>{{ logbook.refno }}</td>
              <td>{{ logbook.name }}</td>
              <td>{{ logbook.concern }}</td>
              
              <td>
                <div class="row gap-3">
                  <router-link :to="`/logbooks/${logbook.id}`" class="p-2 col border btn btn-primary">View</router-link>
                  <router-link :to="`/logbooks/${logbook.id}/edit`" class="p-2 col border btn btn-success">Edit</router-link>
                  <button type="button" class="p-2 col border btn btn-danger" @click="showDeleteModal(logbook)">Delete</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <li class="page-item" :class="{ disabled: logbooks.current_page === 1 }">
              <a class="page-link" @click.prevent="fetchData(logbooks.current_page - 1)" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li v-for="page in logbooks.last_page" :key="page" class="page-item" :class="{ active: page === logbooks.current_page }">
              <a class="page-link" @click.prevent="fetchData(page)" href="#">{{ page }}</a>
            </li>
            <li class="page-item" :class="{ disabled: logbooks.current_page === logbooks.last_page }">
              <a class="page-link" @click.prevent="fetchData(logbooks.current_page + 1)" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  
  <!-- Delete Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete the logbook "{{ logbookToDelete ? logbookToDelete.name : '' }}"?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" @click="deleteLogBook">Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      logbooks: [],
      logbookToDelete: null,
    };
  },
  async mounted() {
    await this.fetchData();
  },
  methods: {
    async fetchData(page = 1) {
      try {
        const response = await axios.get(`/api/logbooks?page=${page}`);
        this.logbooks = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    showDeleteModal(logbook) {
      this.logbookToDelete = logbook;
      $("#deleteModal").modal("show");
    },
    async deleteLogBook() {
      try {
        const id = this.logbookToDelete.id;
        await axios.delete(`/api/logbooks/${id}`);
        this.logbooks.data = this.logbooks.data.filter(logbook => logbook.id !== id);
        $("#deleteModal").modal("hide");
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>

<style scoped>
/* Add custom styles if needed */
.pagination {
  margin-top: 20px;
}

.page-link {
  cursor: pointer;
}
</style>
