<template>
  <main>
  <div class="row">
    <div class="col-md-10 mx-auto">
      <div class="input-group">
        <input class="form-control border-end-0 border" type="search" value="search" id="example-search-input">
        <span class="input-group-append">
                    <button class="btn btn-outline-secondary bg-white border-start-0 border-bottom-0 border ms-n5"
                            type="button">
                      <font-awesome-icon :icon="['fas', 'magnifying-glass']"/>
                    </button>
                </span>
      </div>
    </div>
  </div>

  <!--    List order: -->
  <div class="col-md-10 mx-auto mt-lg-3">
    <span class="title p-2">List Orders : </span>
  </div>
  <div class="col-md-10 mx-auto order">
    <div class="row">
      <div class="col-8">
        <p><NuxtLink class="link-opacity-100-hover" to="/order/1">Order num #01</NuxtLink></p>
      </div>
      <div class="col-4">
        <font-awesome-icon :icon="['fas', 'truck-fast']"/>
        shipping
      </div>
    </div>
    <div class="row">
      <div class="col-8">
        <p>Customer : HuyLT</p>
        <p>shipping date : 19/12/1997</p>
        <p>expected : 10/09/2023</p>
      </div>
    </div>
  </div>

  <div class="col-md-10 mx-auto order">
    <div class="row">
      <div class="col-8">
        <p><a class="link-opacity-100-hover" href="#">Order num #01</a></p>
      </div>
      <div class="col-4">
        <font-awesome-icon :icon="['fas', 'truck-fast']"/>
        shipping
      </div>
    </div>
    <div class="row">
      <div class="col-8">
        <p>Customer : HuyLT</p>
        <p>shipping date : 19/12/1997</p>
        <p>expected : 10/09/2023</p>
      </div>
    </div>
  </div>

  <div class="col-md-10 mx-auto order">
    <div class="row">
      <div class="col-8">
        <p><a class="link-opacity-100-hover" href="#">Order num #01</a></p>
      </div>
      <div class="col-4">
        <font-awesome-icon :icon="['fas', 'truck-fast']"/>
        shipping
      </div>
    </div>
    <div class="row">
      <div class="col-8">
        <p>Customer : HuyLT</p>
        <p>shipping date : 19/12/1997</p>
        <p>expected : 10/09/2023</p>
      </div>
    </div>
  </div>
  </main>
</template>

<script>

import ApiService from "@/api/service.api.js";

export default {
  name: 'IndexPage',
  data() {
    return {
      rating: 3.5,
      user : this.$auth.user
    }
  },
  async mounted() {
    await this.getList();
  },
  methods: {
    setRating: function (rating) {
      alert(1)
    },
    async getList() {
      let res = await ApiService.get('/order')
      console.log(res)
    }
  },
}
</script>
