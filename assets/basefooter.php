<script type="text/javascript">
    function openDelivery(){
        document.getElementById("delivery").style.display="block";
    }
    function closeDelivery(){
        document.getElementById("delivery").style.display="none";
    }
    function openDineinn(){
        document.getElementById("dineinn").style.display="block";
    }
    function closeDineinn(){
        document.getElementById("dineinn").style.display="none";
    }
    function openSalesReturn(){
        document.getElementById("salesreturn").style.display="block";
    }
    function closeSalesReturn(){
        document.getElementById("salesreturn").style.display="none";
    }
    function openSidebar(){
        document.getElementById("side-menu").style.display="block";
        document.getElementById("close-button").style.display="block";
    }
    function closeSidebar(){
        document.getElementById("side-menu").style.display="none";
    }
    function openKotSubmission(){
        document.getElementById("kotsubmission").style.display="block";
    }
    function closeKotSubmission(){
        document.getElementById("kotsubmission").style.display="none";
    }
    function openCustomerCart(){
        document.getElementById("cartList").style.display="block";
    }
    function closeCustomerCart(){
        document.getElementById("cartList").style.display="none";
        window.location="index.php";
    }
    function opencartCheckOut(){
        document.getElementById("cartCheckOut").style.display="block";
    }
    function closecartCheckOut(){
        document.getElementById("cartCheckOut").style.display="none";
        document.getElementById("cartList").style.display="block";
        // window.location="index.php";
    }

    function dineDiscount() {
        var total = Number(document.getElementById("sumtotal").value);
        var discount = Number(document.getElementById("dine_Discount").value);

        var billed = total - discount;
        document.getElementById("calBill").value = billed;

    }

    function openKotItems(){
        document.getElementById("kot_Items").style.display="block";
    }
    function closeKotItems(){
        document.getElementById("kot_Items").style.display="none";
        window.location="kotmeal_orders.php";
    }

    function opencartItems(){
        document.getElementById("cart_Items").style.display="block";
    }
    function closecartItems(){
        document.getElementById("cart_Items").style.display="none";
        window.location="online_orders.php";
    }
    function openprint(){
        document.getElementById("print-page").style.display="block";
    }
    function closeprint(){
        document.getElementById("print-page").style.display="none";
        window.location="online_orders.php";
    }

    function openOnlinedelivery(){
        document.getElementById("delivery_Items").style.display="block";
    }
    function closeOnlinedelivery(){
        document.getElementById("delivery_Items").style.display="none";
        window.location="kotdeliveries.php";
    }
</script>