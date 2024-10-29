<?= loadPartial('head') ?>
<link href="/assets/css/custom.css" rel="stylesheet" />

</head>

<body id="">

<?= loadComponents('layout/nav-bar') ?>
<div class="main-wrapper">
   <?= loadComponents('layout/nav-bar-vertical') ?>
   <!-- main wrapper -->
   <main class="main-content-wrapper">

      <section class="container">
         <?= loadComponents('dashboard/banner' ) ?>
         <?= loadComponents('dashboard/statistic-card' ) ?>
         <div class="row">
            <?= loadComponents('dashboard/revenue' ) ?>
            <?= loadComponents('dashboard/total-sales' ) ?>
         </div>

         <!-- row -->
         <div class="row">
            <?= loadComponents('dashboard/sales-review' ) ?>
            <?= loadComponents('dashboard/notification' ) ?>

         </div>
         <!-- row -->
         <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">
               <div class="card h-100 card-lg">
                  <!-- heading -->
                  <div class="p-6">
                     <h3 class="mb-0 fs-5"> Đơn hàng gần đây </h3>
                  </div>
                  <div class="card-body p-0">
                     <!-- table -->
                     <div class="table-responsive">
                        <table class="table table-centered table-borderless text-nowrap table-hover">
                           <thead class="bg-light">
                              <tr>
                                 <th scope="col">Order Number</th>
                                 <th scope="col">Product Name</th>
                                 <th scope="col">Order Date</th>
                                 <th scope="col">Price</th>
                                 <th scope="col">Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>#FC0005</td>
                                 <td>Haldiram's Sev Bhujia</td>
                                 <td>28 March 2023</td>
                                 <td>$18.00</td>
                                 <td>
                                    <span class="badge bg-light-primary text-dark-primary">Shipped</span>
                                 </td>
                              </tr>
                              <tr>
                                 <td>#FC0004</td>
                                 <td>NutriChoice Digestive</td>
                                 <td>24 March 2023</td>
                                 <td>$24.00</td>
                                 <td>
                                    <span class="badge bg-light-warning text-dark-warning">Pending</span>
                                 </td>
                              </tr>
                              <tr>
                                 <td>#FC0003</td>
                                 <td>Onion Flavour Potato</td>
                                 <td>8 Feb 2023</td>
                                 <td>$9.00</td>
                                 <td>
                                    <span class="badge bg-light-danger text-dark-danger">Cancel</span>
                                 </td>
                              </tr>
                              <tr>
                                 <td>#FC0002</td>
                                 <td>Blueberry Greek Yogurt</td>
                                 <td>20 Jan 2023</td>
                                 <td>$12.00</td>
                                 <td>
                                    <span class="badge bg-light-warning text-dark-warning">Pending</span>
                                 </td>
                              </tr>
                              <tr>
                                 <td>#FC0001</td>
                                 <td>Slurrp Millet Chocolate</td>
                                 <td>14 Jan 2023</td>
                                 <td>$8.00</td>
                                 <td>
                                    <span class="badge bg-light-info text-dark-info">Processing</span>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main>

</div>



   <?= loadPartial('script') ?>
   <script src="/assets/libs/apexcharts/apexcharts.min.js"> </script>
   <script src="/assets/js/chart.js"></script>

</body>

</html>