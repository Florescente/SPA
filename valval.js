// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        var myModal = new bootstrap.Modal(document.getElementById('successmodal'))
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          } 
          form.classList.add('was-validated')
          if (form.checkValidity()) {
            //show
            myModal.show();

            event.preventDefault()
            event.stopPropagation()

            //take data
            const formData = new FormData(form);
            
            //Send to php with fetch           
            fetch("receive.php", {
              method: "post",
              body: formData
            }).then(function (response) {
              return response.text;
            }).then(function (text) {
              //console.log(text);
            }).catch(function (error) {
              console.log(error);
            })

            //reset form
            form.classList.remove('was-validated')
            form.reset()
          }
        }, false)
      })
  })()