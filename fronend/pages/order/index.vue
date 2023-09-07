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
            <strong>$20</strong>
          </li>
        </ul>
      </div>

<!--      Form checkout-->
      <div class="col-md-7 mx-auto">
        <p class="mb-3 title">Billing address</p>
        <form class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Phone number</label>
              <div class="input-group has-validation">
                <input type="number" class="form-control" id="username" placeholder="Username" required>
                <div class="invalid-feedback">
                  Your username is required.
                </div>
              </div>
            </div>
            <div class="col-12">
              <label for="address" class="form-label">Recipient address</label>
              <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping Recipient address.
              </div>
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Shipping address</label>
              <div class="input-group has-validation">
                <input type="number" class="form-control" id="username" placeholder="Username" required>
                <div class="invalid-feedback">
                  Your username is required.
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Province/City</label>
              <select class="form-select" id="country" required>
                <option value="">Choose...</option>CC
                <option>Province/City</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">District</label>
              <select class="form-select" id="state" required>
                <option value="">Choose...</option>
                <option>California</option>
              </select>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>
            <div class="col-12">
              <label for="note" class="form-label">Note</label>
              <div class="input-group has-validation">
                <textarea type="number" class="form-control" id="note" placeholder="Node"  />
              </div>
            </div>
          </div>

          <hr class="my-4">
          <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
        </form>
      </div>
    </div>
  </main>
</template>
<script>
export default {
  name: 'order',
  mounted() {
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
</script>
<style src="~/assets/css/orders/new.css"></style>
