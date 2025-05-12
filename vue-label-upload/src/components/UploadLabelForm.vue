<template>
  <div class="upload-form">
    <h2>Order Information</h2>
    <form @submit.prevent> <!-- Añadido @submit.prevent para evitar envío tradicional del form -->
      <div>
        <label for="orderId">Order ID:</label>
        <input type="number" id="orderId" v-model="orderId" required />
      </div>
      <div>
        <input type="file" @change="handleFileUpload" accept="image/*" />
        <p v-if="file">{{ file.name }}</p>
        <button type="button" @click="uploadLabel" :disabled="!file">Upload Label</button> <!-- type="button" añadido -->
      </div>
    </form>

    <div v-if="order">
      <h3>Order Information</h3>
      <p>Status: {{ order.status }}</p>
      <div v-if="order.label_path" class="download-section"> <!-- Cambiado a order.label_path -->
        <p><strong>Label Image:</strong></p>
        <a :href="order.label_path" target="_blank" class="download-button">View Full Size Label</a> <!-- Abre la imagen directamente en nueva pestaña -->
        <img :src="order.label_path" alt="Label Preview" class="label-preview" /> <!-- Cambiado a order.label_path -->
      </div>
    </div>

    <p v-if="message" :class="{ success: success, error: !success }">{{ message }}</p>
    <p v-if="errorMessage" style="color: red;">{{ errorMessage }}</p>
  </div>
</template>

<script>
import axios from 'axios'; // Descomentamos Axios

export default {
  data() {
    return {
      orderId: '',
      file: null,
      message: '',
      success: false,
      order: null, // Mantendremos esto para la estructura, pero fetchOrder no se llamará aún
      errorMessage: '',
    };
  },
  mounted() {
    console.log('UploadLabelForm component has been mounted (restored basic structure)!');
  },
  watch: { // Reintroducimos el watch
    orderId: {
      handler: 'fetchOrder',
      immediate: true
    }
  },
  methods: {
    async fetchOrder() { // Reintroducimos fetchOrder
      if (!this.orderId) {
        this.order = null;
        // this.message = ''; // Opcional: limpiar mensajes si el orderId se borra
        // this.success = false;
        return;
      }
      console.log(`fetchOrder: Fetching order ${this.orderId}`); // Log para fetchOrder
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/orders/${this.orderId}`);
        console.log('fetchOrder response data:', response.data);
        if (response.data && response.data.id) {
          this.order = response.data;
          // No limpiar this.message aquí para no sobrescribir el mensaje de "successful upload"
        } else {
          this.order = null; // Asegurarse de limpiar this.order si no se encuentra
          this.message = 'Order not found or invalid data received from fetchOrder.';
          this.success = false;
        }
      } catch (error) {
        this.order = null; // Asegurarse de limpiar this.order en caso de error
        this.message = 'Error getting order information during fetchOrder.';
        this.success = false;
        console.error('fetchOrder error:', error.response || error.message || error);
      }
    },
    handleFileUpload(event) {
      this.file = event.target.files[0];
      console.log('handleFileUpload - File selected:', this.file ? this.file.name : 'No file');
      this.errorMessage = '';
      this.message = ''; // Limpiar mensajes anteriores
      this.success = false;
    },
    async uploadLabel() {
      console.log('--- uploadLabel method started ---');
      console.log('Order ID:', this.orderId);
      console.log('File:', this.file ? this.file.name : 'No file');

      if (!this.file) {
        this.errorMessage = 'Please select a file to upload.';
        console.log('uploadLabel: No file selected, exiting.');
        return;
      }

      if (!this.orderId) {
        this.errorMessage = 'Order ID is required to upload a label.';
        console.log('uploadLabel: No Order ID, exiting.');
        return;
      }
      
      
      // this.message = 'Simulating upload...'; // Ya no simulamos
      // this.success = true; 
      
      // this.message = 'Simulating upload...'; // Ya no simulamos
      // this.success = true; 
      // console.log('uploadLabel: Simulating successful upload.');

      // Reintroducimos la lógica de Axios
      let formData = new FormData(); // <--- ASEGURAR QUE ESTA LÍNEA ESTÉ PRESENTE Y DESCOMENTADA
      formData.append('label_image', this.file); // <--- ASEGURAR QUE ESTA LÍNEA ESTÉ PRESENTE Y DESCOMENTADA

      try {
        const response = await axios.post(`http://127.0.0.1:8000/api/orders/${this.orderId}/label`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });

        console.log('Upload response:', response); 
        if (response.data && response.data.message) { // Asumimos que el backend devuelve un mensaje
            this.message = response.data.message; // Usar mensaje del backend si está disponible
        } else {
            this.message = 'successful upload'; // Mensaje genérico si no hay uno específico
        }
        this.success = true;
        this.fetchOrder(); // Llamar a fetchOrder para actualizar datos, incluyendo label_image_path
      } catch (error) {
        this.message = 'Error uploading label.';
        this.success = false;
        console.error('Upload error object:', error); 
        if (error.response) {
          console.error('Error response data:', error.response.data);
          console.error('Error response status:', error.response.status);
          console.error('Error response headers:', error.response.headers);
          this.message = `Error: ${error.response.data.message || error.response.data.error || error.response.statusText || 'Server error'}`;
        } else if (error.request) {
          console.error('Error request:', error.request);
          this.message = 'Error: No response from server. Check network or CORS.';
        } else {
          console.error('Error message:', error.message);
          this.message = `Error: ${error.message}`;
        }
      }
    },
  },
};
</script>

<style scoped>
/* Restauramos los estilos originales */
.upload-form {
  max-width: 400px;
  margin: 2rem auto;
  padding: 2rem;
  border-radius: 10px;
  background-color: #f0f4f8;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.upload-form div:not(.download-section) {
  margin-bottom: 1.5rem;
}
.download-section {
  margin-top: 1rem;
  margin-bottom: 1.5rem;
  padding: 1rem;
  background-color: #e3f2fd;
  border-radius: 5px;
}
.download-section p {
  margin-bottom: 0.5rem;
}
.download-button {
  display: inline-block;
  background-color: #1976d2;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
  text-decoration: none;
  font-size: 0.9rem;
  transition: background-color 0.2s ease-in-out;
  margin-bottom: 0.5rem;
}
.download-button:hover {
  background-color: #1565c0;
}
.label-preview {
  display: block;
  max-width: 100%;
  height: auto;
  margin-top: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.upload-form label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: bold;
  color: #334756;
}

.upload-form input[type="number"],
.upload-form input[type="file"] {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #cbd5e0;
  border-radius: 0.375rem;
  font-size: 1rem;
  color: #334756;
}

.upload-form button {
  background-color: #43a047;
  color: white;
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 0.375rem;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

.upload-form button:hover {
  background-color: #388e3c;
}

.upload-form button:disabled {
  background-color: #9ccc65;
  cursor: not-allowed;
}

.success {
  color: #2e7d32;
  background-color: #c8e6c9;
  padding: 0.75rem;
  border-radius: 0.375rem;
  margin-top: 1rem;
}

.error {
  color: #c62828;
  background-color: #ffcdd2;
  padding: 0.75rem;
  border-radius: 0.375rem;
  margin-top: 1rem;
}
</style>
