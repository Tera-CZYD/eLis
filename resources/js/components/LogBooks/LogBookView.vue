<template>
  <div class="container-fluid px-4" >
    <h1 class="mt-4">LogBook View</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><router-link to="/" class="breadcrumb-item active" style="text-decoration: none;">Dashboard</router-link></li>
      <li class="breadcrumb-item"><router-link to="/logbooks" class="breadcrumb-item active" style="text-decoration: none;">LogBook</router-link></li>
      <li class="breadcrumb-item active">View</li>
    </ol>
    
    <div class="card mb-4">
      <div class="card-body">
        <div>
          <h5 id="associating-form-text-with-form-controls">Reference Number:</h5>
          <h6>{{ logbook.refno }}</h6>
          <h5 id="associating-form-text-with-form-controls">Name:</h5>
          <p>{{ logbook.name }}</p>
          <h5 id="associating-form-text-with-form-controls">Inquiry Type:</h5>
          <p>{{ logbook.log_inquiry_type }}</p>
          <h5 id="associating-form-text-with-form-controls">Concerns:</h5>
          <p>{{ logbook.concerns }}</p>
          <router-link :to="`/logbooks/${logbook.id}/edit`" class="btn btn-primary">Edit</router-link>
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
      logbook: {}
    }
  },
  async created() {
    try {
      console.log('Logbook ID:', this.$route.params.id);
      const response = await axios.get(`/api/logbooks/${this.$route.params.id}`);
      console.log(response.data);
      this.logbook = response.data;
    } catch (error) {
      console.error(error);
    }
  }
}
</script>
