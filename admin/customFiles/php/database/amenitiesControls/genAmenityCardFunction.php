<?php

function generateAmenityCard($amenityData) {
?>
<div class="card card-outline ce-noblank overflow-hidden" data-amid="<?php print $amenityData['amenityID']; ?>">
    <div class="card-header">
        <h3 class="card-title amenity amenity-name" contenteditable="True"><?php print $amenityData['amenityName']; ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool hover-success" onclick="saveAmenity(this)"><i class="fas fa-save fa-lg"></i></button>
            <button type="button" class="btn btn-tool hover-danger" onclick="removeAmenity(this)"><i class="fas fa-times fa-lg"></i></button>
        </div>  
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="form-group m-0">
            <textarea class="form-control" rows="3" placeholder="Enter amenity description"><?php print $amenityData['amenityDesc']; ?></textarea>
        </div>
        <div class="card m-0 bg-gradient-dark">
        <img class="card-img-top" src="/public_assets/amenities/<?php print tonotwtf($amenityData['amenityID'],3); ?>/image.jpeg?t=<?php print time(); ?>" alt="Dist Photo 1">
            <div class="card-img-overlay d-flex flex-column justify-content-start">
            <div class="container-fluid p-0">
                <button for="inp-image-change" class="btn btn-app mb-0 ml-0" onclick="changeImage(this)">
                <i class="fas fa-edit"></i> Change
                </button>
            </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<?php
}
?>