<template>
  <main>
    <div class="row">
      <div class="card col-8">
        <div class="row">
          <div class="title col-9">Order status</div>
          <!-- Button trigger modal -->
          <button type="button" @click="$modal.show('my-modal')"
                  class="btn col-1 btn-review" id="review">
            Review
          </button>
          <button type="button" class="btn col-1 btn-review" id="update" @click="update">
            Update
          </button>
        </div>
        <div class="info">
          <div class="row">
            <div class="col-4">
              <span id="heading">Order No: </span><br>
              <span id="heading">Customer: </span> <br>
              <span id="heading">Recipient address: </span> <br>
              <span id="heading">shipping address: </span> <br>
              <span id="heading">Shipping date: </span> <br>
              <span id="heading">Expected delivery: </span> <br>
            </div>
            <div class="col-8 pull-right">
              <span id="details">012j1gvs356c</span><br>
              <span id="details">HuyLT</span> <br>
              <span id="details">123 Hoang Thai</span> <br>
              <span id="details">124 Hoang Thang</span> <br>
              <span id="details">20/10/1997</span> <br>
              <span id="details">20/10/2023</span> <br>
            </div>
          </div>
        </div>
        <div class="pricing">
          <div class="row">
            <div class="col-9">
              <span id="name">BEATS Solo 3 Wireless Headphones</span>
            </div>
            <div class="col-3">
              <span id="price">&pound;299.99</span>
            </div>
          </div>
          <div class="row">
            <div class="col-9">
              <span id="name">Shipping</span>
            </div>
            <div class="col-3">
              <span id="price">&pound;33.00</span>
            </div>
          </div>
        </div>
        <div class="total">
          <div class="row">
            <div class="col-9"></div>
            <div class="col-3"><big>&pound;262.99</big></div>
          </div>
        </div>
      </div>
      <!--      Tracking-->
      <div class="tracking col-3">
        <div class="title">Tracking Order</div>
        <div class="card-info">
          <div class="card-body">
            <!--            Tracking-->
            <ul class="list-unstyled activity-wid mb-0">
              <li class="activity-list activity-border">
                <div class="activity-icon avatar-sm">
                  <span class="avatar-title bg-main text-primary rounded-circle"></span>
                </div>
                <div class="media">
                  <div class="me-3">
                    <h5 class="font-size-15 mb-1">Step1</h5>
                    <p class="text-muted font-size-14 mb-0">19/12/1997</p>
                  </div>
                </div>
              </li>

              <li class="activity-list activity-border">
                <div class="activity-icon avatar-sm">
                  <span class="avatar-title bg-main text-primary rounded-circle"></span>
                </div>
                <div class="media">
                  <div class="me-3">
                    <h5 class="font-size-15 mb-1">Step1</h5>
                    <p class="text-muted font-size-14 mb-0">19/12/1997</p>
                  </div>
                </div>
              </li>

              <li class="activity-list">
                <div class="activity-icon avatar-sm">
                        <span class="avatar-title bg-soft-success text-success rounded-circle">
                            <i class="fa fa-user font-size-16"></i>
                        </span>
                </div>
                <div class="media">
                  <div class="me-3">
                    <h5 class="font-size-15 mb-1">New Order Received</h5>
                    <p class="text-muted font-size-14 mb-0">Thank You</p>
                  </div>
                </div>
              </li>
            </ul>

          </div>
        </div>
      </div>
      <!--    Comment -->
    </div>
    <div class="row">
      <div class="card mt-lg-3 col-8">
        <div class="title"> Reviews and Comments</div>
        <div class="col-md-8">
          <div class="media g-mb-30 media-comment">
            <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
              <div class="g-mb-15">
                <h5 class="h5 g-color-gray-dark-v1 mb-0">John Doe
                  <star-rating :increment="0.5" :read-only="true" :rating="rating">
                  </star-rating>
                </h5>
                <span class="g-color-gray-dark-v4 g-font-size-12">5 days ago</span>
              </div>

              <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus
                odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                fringilla. Donec lacinia congue
                felis in faucibus ras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--    Popup comment and rate-->
    <modal name="my-modal">
      <div class="modal-content">
        <div class="comment-box text-center">
          <h4>Reviews and Comments</h4>
          <star-rating class="rating" :increment="0.5" :read-only="false" :rating="rating"
                       @rating-selected="setRating"/>
          <div class="comment-area"><textarea class="form-control" placeholder="what is your view?" rows="4"></textarea>
          </div>
          <div class="text-center mt-4">
            <button class="btn btn-review px-5" @click="review">
              Send<i class="fa fa-long-arrow-right ml-1"></i>
            </button>
          </div>
        </div>
      </div>
    </modal>
  </main>
</template>
<script>
export default {
  name: 'detailOrder',
  data() {
    return {
      rating: 3.5,
    }
  },
  methods: {
    setRating: function (rating) {
      alert(1)
    },
    review: function () {

    },
    update: function () {

    }
  },
}
</script>
<style scoped src="~/assets/css/orders/detail.css"></style>
