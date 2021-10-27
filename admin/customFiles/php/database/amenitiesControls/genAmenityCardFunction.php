<?php

function generateAmenityCard($amenityData) {
?>

<div class="card card-outline ce-noblank overflow-hidden" data-amid="<?php print $amenityData['amenityID']; ?>">
    <div class="card-header">
        <h3 class="card-title amenity" contenteditable="True"><?php print $amenityData['amenityName']; ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" onclick="removeAmenityCard(event)">
            <i class="fas fa-times"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="form-group m-0">
            <textarea class="form-control" rows="3" placeholder="Enter amenity description"><?php print $amenityData['amenityDesc']; ?></textarea>
        </div>
        <div class="card m-0 bg-gradient-dark">
        <img class="card-img-top" src="/public_assets/amenities/<?php print tonotwtf($amenityData['amenityID'],3); ?>/image.jpeg" alt="Dist Photo 1">
            <div class="card-img-overlay d-flex flex-column justify-content-start">
            <div class="container-fluid p-0">
                <a class="btn btn-app mb-0 ml-0">
                <i class="fas fa-edit"></i> Change
                </a>
            </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<?php
}
?>