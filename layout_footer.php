</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    let nameNode = document.getElementsByName("name");
    let errNode1 = document.getElementById("name_err");

    function validate1() {
        errNode1.innerHTML = "";
        let name = nameNode.value;
        let regName = new RegExp("^[a-zA-Z0-9]+$");
        if (name === "") {
            errNode1.style.color = "red";
            errNode1.innerHTML = "<b>This field is required</b>";

            return false;
        } else if (!regName.test(name)) {
            errNode1.style.color = "red";
            errNode1.innerHTML = "<b>You can only use alphabets</b>";

            return false;
        } else
            return true;
    }

    let priceNode = document.getElementsByName('price');
    let errNode2 = document.getElementById("price_err");

    function validate2(){
        errNode2.innerHTML = "";
        let price = priceNode.value;
        let regName = new RegExp("^[+-]?([0-9]+\.?[0-9]*|\.[0-9]+)$");
        if (price === "") {
            errNode2.style.color = "red";
            errNode2.innerHTML = "<b>This field is required</b>";
            return false;
        } else if (!regName.test(price)) {
            errNode2.style.color = "red";
            errNode2.innerHTML = "<b>Invalid</b>";
            return false;
        } else
            return true;
    }

    function validateForm() {
        let st1 = validate1();
        let st2 = validate2();
        return (st1 && st2);
    }
</script>
<script>
    // JavaScript for deleting product
    $(document).on('click', '.delete-object', function() {

        var id = $(this).attr('delete-id');

        bootbox.confirm({
            message: "<h4>Are you sure?</h4>",
            buttons: {
                confirm: {
                    label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                    className: 'btn-danger'
                },
                cancel: {
                    label: '<span class="glyphicon glyphicon-remove"></span> No',
                    className: 'btn-primary'
                }
            },
            callback: function(result) {

                if (result == true) {
                    $.post('delete.php', {
                        object_id: id
                    }, function(data) {
                        location.reload();
                    }).fail(function() {
                        alert('Unable to delete.');
                    });
                }
            }
        });

        return false;
    });
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

</body>

</html>