<?php
$page_title = 'Manage Program Fees';
require_once './includes/header.php';
require_once '../app/fee_func.php';
$programs = fetchAll('tbl_programs', $pdo);
if (isset($_GET["id"])) {
  $item = fetchItem('tbl_programs', $_GET["id"], $pdo);
  $fees = fetchFeesOnProgram($_GET["id"], $pdo);
}
?>

<!-- Main Content -->
<main>
  <div class="program-fees">
    <div class="card">
      <div class="card-header">
        <div class="input-with-icon">
          <i class="bi bi-search"></i>
          <input type="text" class="input-control search" placeholder="Search" id="program-search">
        </div>
      </div>
      <div class="">
        <ul class="card-list" id="program-list">
          <li>
            <a href="program_fees.php" class="<?php echo (!isset($_GET["id"])) ?  'active' : '' ?>">General Fees</a>
          </li>
          <?php
          foreach ($programs as $program) {
          ?>
            <li><a href='<?= "./program_fees.php?id=" . $program['id'] ?>' class="<?php echo ($_GET["id"] == $program['id']) ?  'active' : '' ?>">
                <?= ucwords(strtolower($program['program_name'])); ?>
              </a></li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
    <?php if (isset($_GET["id"])) { ?>
      <div class="card">
        <div class="card-header">
          <div class="program-label">
            <p>Program Name</p>
            <h2><?= $item['program_name'] ?></h2>
          </div>
        </div>
        <div class="card-body">
          <div class="program-label">
            <p>Fee Structure</p>
          </div>
          <form action="../app/fee_update.php" method="post">
            <input type="number" value="<?= $_GET["id"] ?>" name="program_id" hidden>
            <div class="input-list" id="input-list">
              <div class="fee">
                <label for="">Tuition Fee (per unit)</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['tuition_fee'] ?>" name="tuition_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Miscellaneous Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['misc_fee'] ?>" name="misc_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Registration Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['registration_fee'] ?>" name="registration_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Library Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['library_fee'] ?>" name="library_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Laboratory Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['laboratory_fee'] ?>" name="laboratory_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Guidance Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['guidance_fee'] ?>" name="guidance_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Computer Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['computer_fee'] ?>" name="computer_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Athletic Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['athletic_fee'] ?>" name="athletic_fee">
                </div>
              </div>
            </div>
            <div class="edit-btn-group">
              <button type="button" class="btn-outline gray" id="cancel-btn">Cancel</button>
              <button type="submit" class="btn positive" id="save-btn">Save Changes</button>
              <button type="button" class="btn" id="edit-btn">Edit Fees</button>
            </div>
          </form>
        </div>
      </div>
    <?php } else { ?>
      <div class="card">
        <div class="card-header">
          <div class="program-label">
            <h2>Update all Fees</h2>
            <h4>The values submitted in this form will update the fee structures of all the college programs in the system.</h4>
          </div>
        </div>
        <div class="card-body">
          <div class="program-label">
            <p>Fee Structure</p>
          </div>
          <form action="../app/fee_update_all.php" method="post">
            <div class="input-list" id="input-list">
              <div class="fee">
                <label for="">Tuition Fee (per unit)</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['tuition_fee'] ?>" name="tuition_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Miscellaneous Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['misc_fee'] ?>" name="misc_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Registration Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['registration_fee'] ?>" name="registration_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Library Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['library_fee'] ?>" name="library_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Laboratory Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['laboratory_fee'] ?>" name="laboratory_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Guidance Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['guidance_fee'] ?>" name="guidance_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Computer Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['computer_fee'] ?>" name="computer_fee">
                </div>
              </div>
              <div class="fee">
                <label for="">Athletic Fee</label>
                <div class="input-with-currency">
                  <div class="currency">Php</div>
                  <input type="number" placeholder="1.00" step="0.01" class="input-control gray" disabled value="<?= $fees['athletic_fee'] ?>" name="athletic_fee">
                </div>
              </div>
            </div>
            <div class="edit-btn-group">
              <button type="button" class="btn-outline gray" id="cancel-btn">Cancel</button>
              <button type="submit" class="btn positive" id="save-btn">Save Changes</button>
              <button type="button" class="btn" id="edit-btn">Edit Fees</button>
            </div>
          </form>
        </div>
      </div>
    <?php } ?>

  </div>
</main>

<?php
require_once  './includes/footer.php'
?>