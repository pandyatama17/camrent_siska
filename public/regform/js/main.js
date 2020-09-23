$(function(){
  var form = $("#form-register");
  var container = $("#form-total");
    form.validate({
        // errorElement: "legend", // default is 'label'
        errorPlacement: function errorPlacement(error, element) { error.insertBefore(element.parent('fieldset')); },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });
    container.steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        stepsOrientation: "vertical",
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        labels: {
            // previous : 'Back Step',
            previous : '<i class="zmdi zmdi-arrow-left"></i>',
            next : '<i class="zmdi zmdi-arrow-right"></i>',
            finish : '<i class="zmdi zmdi-check"></i>',
            current : ''
        },
        onStepChanging: function(event, currentIndex, newIndex)
        {
          // Always allow going backward even if the current step contains invalid fields!
          if (currentIndex > newIndex) {
            return true;
          }
          // Clean up if user went backward before
          if (currentIndex < newIndex) {
            // To remove error styles
            $(".body:eq(" + newIndex + ") label.error", form).remove();
            $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
          }
          // Disable validation on fields that are disabled or hidden.
          form.validate();

          // Start validation; Prevent going forward if false
          return form.valid();
        },
        onFinishing: function(event, currentIndex)
        {
          // Disable validation on fields that are disabled.
          // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
          form.validate().settings.ignore = ":disabled";
          // Start validation; Prevent form submission if false
          return form.valid();
        },
        onFinished: function(event, currentIndex) {
          // Submit form input
          form.submit();
        }
    });
});
