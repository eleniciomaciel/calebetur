<div class="main-panel">
  <!-- Navbar -->
  <?php
  $this->load->view('adm/includes/nav');
  ?>
  <!-- End Navbar -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <?php
        $this->load->view('adm/includes/card-stats');
        ?>
      </div>
      <div class="row">
        <?php
        $this->load->view('adm/includes/card-table');
        ?>
      </div>
    </div>
  </div>
  <?php
  $this->load->view('adm/includes/footer');
  ?>
</div>