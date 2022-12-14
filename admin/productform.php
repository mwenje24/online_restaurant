<form class="row g-3" action="" enctype="multipart/form-data" method="POST">
    <?php if($product['image']): ?>
        <img class="update-image" src="../assets/<?php echo $product['image'] ?>">
    <?php endif; ?>
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">Product Image</label><br>
            <input class="form-control" type="file" name="image"/>
        </div>
        <div class="col-md-6">
            <label class="form-label">Category</label>
            <select class="form-select form-control sm" name="category"><?php echo $category ?>
                <!-- <option selected>Open this select menu</option> -->
                <?php foreach ($categorys as $category): ?>
                    <option><?php echo $category['category_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label class="form-label">Product Description</label>
            <textarea name="description" type="text" class="form-control" required><?php echo $description ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">price</label>
            <input type="number" name="price" step=".01" class="form-control" value="<?php echo $price ?>" required/>
        </div>
        <div class="col-md-6">
        <label class="form-label">Status</label>
        <select class="form-select form-control sm" value="<?php echo $status ?>" name="status">
            <!-- <option selected>Open this select menu</option> -->
            <option value="available">available</option>
            <option value="out of stock">out of stock</option>
        </select>
        </div>
    </div>
    <p>
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
</form><br>