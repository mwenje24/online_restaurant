<form class="row g-3" action="" enctype="multipart/form-data" method="POST">
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">First Name</label>
            <input type="text" value="<?php echo $firstname ?>" name="firstname" class="form-control" required/>
        </div>
        <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" value="<?php echo $lastname ?>" name="lastname" class="form-control"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">E-mail</label>
            <input type="text" value="<?php echo $email ?>" name="email" class="form-control" required/>
        </div>
        <div class="col-md-6">
            <label class="form-label">Phone Number</label>
            <input type="text" value="<?php echo $phone ?>" name="phone" class="form-control"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">City/Town</label>
            <input type="text" value="<?php echo $town ?>" name="town" class="form-control" required/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label class="form-label">Street/Address</label>
            <textarea name="street" type="text" class="form-control" required><?php echo $street ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">Enter Password</label>
            <input type="text" name="password" value="<?php echo $password ?>" class="form-control" required/>
        </div><br>
    </div>
    <p>
    