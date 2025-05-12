<script>
import UploadLabelForm from './components/UploadLabelForm.vue';

import axios from 'axios';

export default {
  components: {
    UploadLabelForm,
  },
  mounted() {
    this.getCsrfToken();
  },
  methods: {
    async getCsrfToken() {
      await axios.get('http://localhost:8000/sanctum/csrf-cookie');
    }
  }
};
</script>

<template>
 <UploadLabelForm />
</template>

<style scoped>
#app {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #e2e8f0;
}
</style>
