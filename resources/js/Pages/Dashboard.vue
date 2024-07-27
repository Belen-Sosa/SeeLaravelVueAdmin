<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
  <AppLayout title="Dashboard">
    <div
      class="relative flex flex-col min-h-screen bg-center selection:bg-red-500 selection:text-white"
      :style="{ backgroundImage: 'url(/imgs/imagenBanner1.jpg)', backgroundSize: 'cover', backgroundPosition: 'center' }"
    >
      <div class="overlay"></div> <!-- Overlay layer for background opacity -->
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10"> <!-- Ensure content is above the overlay -->
        <div class=" sm:rounded-lg">
          <Welcome />
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.6); /* Adjust the opacity as needed */
  z-index: 1; /* Ensure the overlay is behind the content */
}

.relative > .max-w-7xl {
  z-index: 2; /* Ensure the content is on top of the overlay */
}

@media (prefers-color-scheme: dark) {
  .dark\:bg-dots-lighter {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
  }
}

.bg-footer {
  background-color: #15191d;
}

footer {
  position: relative;
  bottom: 0;
  left: 0;
  right: 0;
}
</style>
