<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="header">
      <div class="container-fluid">
        <NuxtLink class="navbar-brand" to="/">Home</NuxtLink>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <NuxtLink type="button" class="btn btn-success m-lg-3" to="/order">New Order</NuxtLink>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="profile">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                User
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container mt-lg-2">
      <Nuxt/>
    </div>
  </div>
</template>
<style>
#header {
  padding: 10px;
}
</style>
<script setup>
</script>
