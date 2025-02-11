<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud-ajax</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .dynamic-popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1050;
        width: 80%;
        max-width: 500px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
        padding: 20px;
        display: none;
    }

    .dynamic-popup .btn-close {
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>

<body>
    <!-- Add Student Form and Update Student Popup -->
    <div class="container mt-4">
        <div class="row justify-content-center text-center">
            <div class="col-md-6">
                <h2 class="mb-4">Student Form</h2>
                <?php if ($this->session->flashdata('error')) {
                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                } ?>
                <div class="feedback" style="color: red;"></div>

                <?php echo form_open(); ?>
                <div class="form-group my-2">
                    <?php echo form_input(array(
                        'name' => 'name', 'value' => '',
                        'class' => 'name form-control', 'placeholder' => 'Enter Your Name'
                    )); ?>
                </div>
                <div class="form-group my-2">
                    <?php echo form_input(array(
                        'name' => 'email', 'value' => '',
                        'class' => 'email form-control', 'placeholder' => 'Enter Your Email'
                    )); ?>
                </div>
                <div class="form-group my-2">
                    <?php echo form_password(array(
                        'name' => 'password', 'value' => '',
                        'class' => 'password form-control', 'placeholder' => 'Enter Your Password'
                    )); ?>
                </div>
                <div class="form-group my-2">
                    <?php echo form_submit(array(
                        'name' => 'submit', 'value' => 'Submit',
                        'class' => 'submit btn btn-primary btn-block'
                    )); ?>
                </div>
                <?php echo form_close(); ?>

                <div class="dynamicContent dynamic-popup">
                    <button type="button" class="btn-close" aria-label="Close"></button>
                    <div class="dyFeedback" style="color: red;"></div>
                    <div class="content-container">
                        <!-- Dynamic content will be injected here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="container mt-4">
        <div class="row justify-content-center text-center">
            <div class="col-md-12">
                <h2 class="mb-4">Student Records</h2>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr class="table-success">
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Date</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($allRecords) && $allRecords) : ?>
                            <?php foreach ($allRecords->result() as $std) : ?>
                                <tr>
                                    <td class="dyId<?php $std->stId; ?>">
                                        <?= $std->stId; ?>
                                    </td>
                                    <td class="dyName<?php $std->stName; ?>">
                                        <?= $std->stName; ?>
                                    </td>
                                    <td class="dyEmail<?php $std->stEmail; ?>">
                                        <?= $std->stEmail; ?>
                                    </td>
                                    <td class="dyPassword<?php $std->stPassword; ?>">
                                        <?= $std->stPassword; ?>
                                    </td>
                                    <td><?= date('d-m-Y', strtotime($std->stDate)); ?></td>
                                    <td>
                                        <a href="javascript:void(0)" data-text="<?php echo $this->encryption->encrypt($std->stId) ?>" data-id="<?php echo $std->stId; ?>" class="edit">EDIT</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center">No data exists</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        var ajaxUrl = "<?php echo site_url(); ?>";
    </script>
    <script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
</body>

</html>