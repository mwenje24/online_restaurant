<form class="row g-3" action="" enctype="multipart/form-data" method="POST">
    <div class="row">
        <div class="col-md-8">
            <label class="form-label">Full Names</label>
            <input type="text" value="<?php echo $fullnames ?>" name="fullnames" class="form-control" required/>
        </div>
        <div class="col-md-8">
            <label class="form-label">email</label>
            <input type="text" value="<?php echo $email ?>" name="email" class="form-control"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <label class="form-label">Username</label>
            <input type="text" value="<?php echo $username ?>" name="username" class="form-control" required/>
        </div>
        <div class="col-md-8">
            <label class="form-label">Password</label>
            <input type="text" value="<?php echo $password ?>" name="password" class="form-control"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">Type</label>
            <select class="form-select form-control sm" value="<?php echo $type ?>" name="type"><?php echo $type ?>
                <option value="user">user</option>
                <option value="admin">admin</option>
                <option value="super admin">super admin</option>
            </select>
        </div>
        <div class="col-md-2">
        <br><br><br><br><br><br>
            <button style="float:right; width:100%;" type="submit" class="btn btn btn-primary">Submit</button>
        </div>
    </div>
</form><br>