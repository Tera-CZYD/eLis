<template>
  <div class="container-fluid px-4" >
    <h1 class="mt-4" v-if="isNewLogBook">LogBook Add</h1>
    <h1 class="mt-4" v-else>LogBook Edit</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><router-link to="/" class="breadcrumb-item active" style="text-decoration: none;">Dashboard</router-link></li>
      <li class="breadcrumb-item"><router-link to="/logbooks" class="breadcrumb-item active" style="text-decoration: none;">LogBook</router-link></li>
      <li class="breadcrumb-item active" v-if="isNewLogBook">Add</li>
      <li class="breadcrumb-item active" v-else>Edit</li>
    </ol>
    
    <div class="card mb-4">
      <div class="card-body">
        <div>
          <h2 v-if="isNewLogBook">Add LogBook</h2>
          <h2 v-else>Edit LogBook</h2>
          <form @submit.prevent="submitForm">
            <div class="mb-3">
              <label for="refno" class="form-label">Reference Number:</label>
              <input class="form-control" type="text" id="refno" v-model="logbook.refno" required />
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Name:</label>
              <input class="form-control" type="text" id="name" v-model="logbook.name" required />
            </div>
            <div class="mb-3">
              <label for="dept" class="form-label">Department:</label>
              <input class="form-control" type="text" id="dept" v-model="logbook.department_id" required />
            </div>
            <div class="mb-3">
              <label for="type" class="form-label">Inquiry Type:</label>
              <input class="form-control" type="text" id="type" v-model="logbook.log_inquiry_type" required />
            </div>
            <div class="mb-3">
              <label for="concern" class="form-label">Concerns:</label>
              <input class="form-control" type="text" id="concern" v-model="logbook.concerns" required />
            </div>
            <button type="submit" v-if="isNewLogBook" class="btn btn-primary">Add LogBook</button>
            <button type="submit" v-else class="btn btn-primary">Update LogBook</button>
          </form>
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
      logbook: {
        refno: '',
        name: '',
        department_id: 0,
        log_inquiry_type: '',
        concerns:''
      }
    }
  },
  computed: {
    isNewLogBook() {
      return !this.$route.path.includes('edit');
    }
  },
  async created() {
    if (!this.isNewLogBook) {
      const response = await axios.get(`/api/logbooks/${this.$route.params.id}`);
      this.logbook = response.data;
    }
  },
  methods: {
    async submitForm() {
      // console.log(this.logbook); 
      try {
        if (this.isNewLogBook) {
          await axios.post('/api/logbooks', this.logbook);
        } else {
          await axios.put(`/api/logbooks/${this.$route.params.id}`, this.logbook);
        }
        this.$router.push('/');
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>