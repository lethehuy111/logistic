<template>
  <main>
    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your Free</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between">
            <span>shipping Fee (VND)</span>
            <strong>{{ formatMoney(formData.shipping_fee) }}</strong>
          </li>
        </ul>
      </div>

<!--      Form checkout-->
      <div class="col-md-7 mx-auto">
        <p class="mb-3 title">Billing address</p>
        <form class="needs-validation" novalidate id="form-order">
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Sender name</label>
              <input type="text" class="form-control" required v-model="formData.sender_name">
              <div class="invalid-feedback">
                Valid Sender name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Recipienter name</label>
              <input type="text" class="form-control" required v-model="formData.recipienter_name">
              <div class="invalid-feedback">
                Valid Recipienter name is required.
              </div>
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Sender Phone number</label>
              <div class="input-group has-validation">
                <input type="number" class="form-control" placeholder="Username" required v-model="formData.phone">
                <div class="invalid-feedback">
                  Phone number is required.
                </div>
              </div>
            </div>
            <div class="col-12">
              <label for="username" class="form-label">Recipient Phone number</label>
              <div class="input-group has-validation">
                <input type="number" class="form-control" required v-model="formData.phone_reception">
                <div class="invalid-feedback">
                  Recipient Phone number is required.
                </div>
              </div>
            </div>
            <div class="col-12">
              <label for="username" class="form-label">Product name</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" required v-model="formData.product_name">
                <div class="invalid-feedback">
                  Product name is required.
                </div>
              </div>
            </div>
            <div class="col-12">
            <label for="username" class="form-label">Weight </label>
            <div class="input-group has-validation">
              <input type="number" class="form-control" @change="getShippingFee" required v-model="formData.weight">
              <div class="invalid-feedback">
                Weight is required.
              </div>
            </div>
          </div>
            <div class="col-12">
              <label for="address" class="form-label">Recipient address</label>
              <input type="text" class="form-control" id="address" placeholder="1234 Main St" required
                     v-model="formData.recipient_address">
              <div class="invalid-feedback">
                Please enter your shipping Recipient address.
              </div>
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Shipping address</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" placeholder="1234 Main St" required
                  v-model="formData.shipping_address">
                <div class="invalid-feedback">
                  Shipping address is required.
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <label for="country" class="form-label">Recipient Province/City</label>
              <select class="form-select" required v-model="formData.province_recipient_id" @change="getShippingFee">
                <option value="">Choose...</option>
                <option v-for="(province, index) in provinces" :key="index" :value="province.id">
                  {{province.name}}
                </option>
              </select>
              <div class="invalid-feedback">
                Please provide a Recipient Province/City
              </div>
            </div>
            <div class="col-md-4">
              <label for="state" class="form-label">Shipping Province/City</label>
              <select class="form-select" id="state" required @change="getShippingFee" v-model="formData.province_shipping_id">
                <option value="">Choose...</option>
                <option v-for="(province, index) in provinces" :key="index" :value="province.id">
                  {{province.name}}
                </option>
              </select>
              <div class="invalid-feedback">
                Please provide a shipping Province/City
              </div>
            </div>
            <div class="col-12">
              <label for="note" class="form-label">Note</label>
              <div class="input-group has-validation">
                <textarea type="number" class="form-control" id="note" placeholder="Node" v-model="note"/>
              </div>
            </div>
          </div>

          <hr class="my-4">
          <button class="w-100 btn btn-primary btn-lg" type="submit" @click.prevent="submit">Checkout</button>
        </form>
      </div>
    </div>
  </main>
</template>
<script>
import ApiService from "@/api/service.api";
import {formatMoney} from "@/common/function";

export default {
  name: 'order',
  data() {
    return {
       provinces : [],
       formData : {
         "phone" : "",
         "phone_reception" : "",
         "sender_name" : this.$auth.user.name,
         "recipienter_name" : "",
         "shipping_address" : "",
         "recipient_address" : "",
         "province_shipping_id" : this.$auth.user.stock_id,
         "province_recipient_id" : "",
         "product_name" : "",
         "shipping_fee" : 0,
         "weight" : ""
       },
       note : ""
    }
  },
  async mounted() {
    this.validateJs()
    this.getProvinces()
  },
  methods: {
    formatMoney,
    async getProvinces() {
      let response = await ApiService.get('/province-stock')
      this.provinces = response.result
    },
    async getShippingFee() {
      if (this.formData.province_shipping_id && this.formData.province_recipient_id && this.formData.weight) {
        let response = await ApiService.get('order/get-price-weight',  {
          'weight' : this.formData.weight,
          'province_shipping_id' : this.formData.province_shipping_id,
          'province_recipient_id': this.formData.province_recipient_id,
        })

        this.formData.shipping_fee = response.result ? response.result.shipping_fee : 0
      } else {
        this.formData.shipping_fee = 0
      }
    },
    async submit() {
      console.log(this.validateForm())
      if (this.validateForm()) {
        let res = await ApiService.post('order/store', this.formData)
        if (typeof res !== 'undefined' && res.return) {
          this.$swal({
            icon: 'success',
            text: 'Order succes!'
          })
          await this.$router.push('/');
        }
      }
      this.validateJs()
    },
    validateForm() {
      for (const [key, value] of Object.entries(this.formData)) {
        if (value === null || value === "") return false
      }
      return true
    },
    validateJs() {
      let forms = document.querySelectorAll('.needs-validation')

      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add('was-validated')
          }, false)
        })
    }
  }
}
</script>
<style src="~/assets/css/orders/new.css"></style>
