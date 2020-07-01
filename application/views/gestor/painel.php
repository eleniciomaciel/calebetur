    <div class="main-panel">
      <!-- Navbar -->
        <?php
            $this->load->view('gestor/includes/navbar');
        ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <?php
                $this->load->view('gestor/includes/card-stats');
            ?>
          </div>
          <div class="row">
            <div class="col-md-12">
            <?php
                $this->load->view('gestor/includes/tabs-navigation');
            ?>
            </div>
          </div>
        </div>
      </div>
    <?php
        $this->load->view('gestor/includes/footer-html');
    ?>
    </div><!-- Navbar -->