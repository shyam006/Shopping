@extends('layout.app')

@section('content')

<script src="{{ asset('assets/WYSIWYG/editor.js') }}"></script>
<script>
$(document).ready(function() {
    $("#txtEditor").Editor();
    setTimeout(() => {
        $('.Editor-container').css({"width": "160%","margin-left": "-150px"});
    }, 300);
});
</script>
<!-- <link rel="stylesheet" href="{{ asset('assets/WYSIWYG/bootstrap.min.css') }}">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
<link href="{{ asset('assets/WYSIWYG/editor.css') }}" type="text/css" rel="stylesheet"/>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800"></h1>
  <a class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" href="/Product">Back</a>
</div>
<section class="section">
    <h1>Add your Product</h1>
    <div class="form-progress">
        <progress class="form-progress-bar" min="0" max="100" value="0" step="33" aria-labelledby="form-progress-completion"></progress>		
        <div class="form-progress-indicator one active"></div>
        <div class="form-progress-indicator two"></div>
        <div class="form-progress-indicator three"></div>
        <div class="form-progress-indicator four"></div>		
        <p id="form-progress-completion" class="js-form-progress-completion sr-only" aria-live="polite">0% complete</p>
    </div>	
    <div class="animation-container">
      <form action="/add_new_product" method="post"  enctype="multipart/form-data">
      @csrf
        <!-- Step one -->
        <div class="form-step js-form-step" data-step="1">
            <div class="form">
                <div class="fieldgroup">
                    <select name="category" class="form-control" id="category">
                        <option value="">Please Select Category</option>
                        @foreach($category as $cate)
                        <option value="{{ $cate->category_id }}">{{ $cate->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fieldgroup">
                    <select name="subcategory" class="form-control" id="subcategory" disabled readonly>
                        <option value="">Please Select Sub Category</option>
                    </select>
                </div>
                <div class="fieldgroup">
                    <input type="text" name="name" id="name" placeholder="Product Name" />
                </div>
                <div class="fieldgroup">
                    <input type="text" class="numbers" name="price" id="price" placeholder="Price"/>
                </div>
                <div class="fieldgroup">
                    <button type="button" class="btn btn-sm btn-block pripic">Select Primary Image <span id="labelpri"></span></button>
                    <input type="file" class="d-none" name="primarypic" id="pripic" />
                </div>
                <div class="fieldgroup">
                    <button type="button" class="btn btn-sm btn-block pic">Select Other Images <span id="labelother"></span></button>
                    <input type="file" class="d-none" name="pic[]" id="pic" multiple/>
                </div>
                <div class="buttons mb-1">
                    <button type="button" class="btn w-50 next1 mx-auto">Continue</button>
                </div>
            </div>
        </div>		
        <!-- Step two -->
        <div class="form-step js-form-step waiting hidden" data-step="2">
            <div class="form">
                <h6 class="text-center">Description</h6>
                <div class="fieldgroup">
                <textarea style="width: 160%%;margin-left: -150px;" name="description" id="txtEditor" class="form-control"></textarea>
                <p class="text-right">Min Chars: 300</p>
                </div>
                <div class="buttons mb-1">
                    <button type="button" class="btn w-100 btn-alt mr-3 back">Back</button>
                    <button type="button" class="btn w-100 next2">Continue</button>
                </div>
            </div>
        </div>		
        <!-- Step three -->
        <div class="form-step js-form-step waiting hidden" data-step="3">
            <div class="form">
                <h6 class="text-center">Specifications</h6>
                <div id="specificatio_feilds"></div>
                <div class="buttons mb-1">
                    <button type="button" class="btn w-100 btn-alt mr-3 back">Back</button>
                    <button type="button" class="btn w-100 next3">Continue</button>
                </div>
            </div>
        </div>
        <!-- Step four -->
        <div class="form-step js-form-step waiting hidden" data-step="4">
            <div class="form">
                <h6 class="text-center">Acknowledgement</h6>
                <div class="custom-control custom-checkbox small mb-4">
                  <span style="font-size: 20px;">Are you sure the details that you have entered is accurate for that product..?<br>Please Check the details Once again..</span>
                </div>
                <div class="buttons mb-1">
                    <button type="button" class="btn w-100 btn-alt mr-3 back">Back</button>
                    <button type="submit" class="btn w-100">Add Product</button>
                </div>
            </div>
		  </div>
    </form>
	</div>
</section>
<style>


.btn-group .btn
{
    color: #000;
    background-color: #fff;
    padding: 5px!important;
    font-size: 0.9rem !important;
    line-height: 1rem;
    border-radius: 5px !important;
}
.btn-group .btn:hover
{
    color: #000;
    background-color: #ededed;
    padding: 5px!important;
    font-size: 0.9rem !important;
    line-height: 1rem;
    border-radius: 5px !important;
}
/** fadeInLeft **/
@-webkit-keyframes fadeInLeft {
    from {
        opacity:0;
        -webkit-transform: translatex(-10px);
        -moz-transform: translatex(-10px);
        -o-transform: translatex(-10px);
        transform: translatex(-10px);
    }
    to {
        opacity:1;
        -webkit-transform: translatex(0);
        -moz-transform: translatex(0);
        -o-transform: translatex(0);
        transform: translatex(0);
    }
}
@-moz-keyframes fadeInLeft {
    from {
        opacity:0;
        -webkit-transform: translatex(-10px);
        -moz-transform: translatex(-10px);
        -o-transform: translatex(-10px);
        transform: translatex(-10px);
    }
    to {
        opacity:1;
        -webkit-transform: translatex(0);
        -moz-transform: translatex(0);
        -o-transform: translatex(0);
        transform: translatex(0);
    }
}
@keyframes fadeInLeft {
    from {
        opacity:0;
        -webkit-transform: translatex(-100px);
        -moz-transform: translatex(-100px);
        -o-transform: translatex(-100px);
        transform: translatex(-100px);
    }
    to {
        opacity:1;
        -webkit-transform: translatex(0);
        -moz-transform: translatex(0);
        -o-transform: translatex(0);
        transform: translatex(0);
    }
}
body.freeze {
  pointer-events: none;
}
h1 {
  margin: 0;
  margin-bottom: 2rem;
  text-align: center;
  font-weight: normal;
  line-height: 2.2rem;
}
.section {
    max-width: 70%;
    padding: 1rem;
    margin: -6vh auto 3vh auto;
    background: white;
    border-radius: 20px;
    box-shadow: 0 1px 10px rgba(0, 0, 0, 0.3);
}
.section:before {
  content: "";
  width: 100%;
  background: #0ce479;
  height: 170px;
  position: absolute;
  top: 0;
  left: 0;
  z-index: -1;
  border-bottom: rgba(0, 0, 0, 0.2);
}
.form-instructions {
  text-align: center;
}
.form {
  margin: auto;
  width: 100%;
  max-width: 500px;
  will-change: transform;
}
.fieldgroup {
  margin: 0.6rem 0;
  position: relative;
  padding: 1px
}
label {
  position: absolute;
  top: 0.8rem;
  left: 0;
  display: block;
  font-size: 1rem;
  transition: 0.2s ease-out;
  opacity: 0.5;
  will-change: top, font-size;
}
label:hover {
  cursor: text;
}
input {
  border: #fff;
  font-size: 1.2rem;
  padding: 0.6rem;
  padding-left: 0;
  background: transparent;
  border: none;
  border-bottom: #444;
  transition: 0.2s;
  width: calc(100% - .6rem);
  border-radius: 0;
}
input:focus {
  outline: none;
  border-bottom: #2196f3 !important;
}
input:valid {
  border-color: #444;
}
input:focus + label, input.hasInput + label {
  top: -0.8rem;
  font-size: 0.7rem;
}
.btn {
  color: #fff;
  background-color: #0bcc6c;
  padding: 0.8rem;
  font-size: 1.2rem;
  line-height: 1.2rem;
  border-radius: 5px;
  border: 2px solid transparent;
  min-width: 45px !important;
}
.btn:hover, .btn.hover {
  color: #fff;
  background-color: #1fe080;
  text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
  transition: 0.2s;
}
.btn:active, .btn.active {
  color: #fff;
  background-color: #00b858;
  box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.3);
  outline: 2px solid #0bcc6c;
}
.btn:focus, .btn.focus {
  color: #fff;
  outline: 2px solid #0bcc6c;
  outline-offset: 2px;
}
.btn:active:focus, .btn.active.focus {
  outline: 4px solid #0bcc6c;
}
.btn.hover, .btn.active {
  outline: none;
}
.btn-alt {
  background-color: transparent;
  color: #0bcc6c;
  border: 2px solid #0bcc6c;
}
.btn-alt:hover, .btn-alt.hover {
  background-color: transparent;
  color: #00a444;
  border-color: #00a444;
  text-shadow: none;
}
.btn-alt:focus, .btn-alt.focus {
  color: #00b858;
}
.btn-alt:active, .btn-alt.active {
  color: #fff;
  background-color: #0bcc6c;
  text-shadow: 0 -1px 0 rgba(255, 255, 255, 0.2);
}
.btn-alt.hover, .btn-alt.active {
  outline: none;
}
.buttons {
  display: flex;
}
.buttons .btn {
  /* margin-right: 15px; */
}
form .btn {
  display: inline-block;
  width: 100%;
}
[data-step="4"] button.btn {
  display: block;
  margin: 0 auto;
}
.form-progress {
  position: relative;
  display: block;
  margin: 1.3rem auto;
  width: 100%;
  max-width: 400px;
}
progress {
  display: block;
  position: relative;
  top: 5px;
  left: 5px;
  -webkit-appearance: none;
  appearance: none;
  background: #0bcc6c;
  width: 100%;
  height: 5px;
  background: none;
  transition: 1s;
  will-change: contents;
}
progress::-webkit-progress-bar {
  background-color: #ddd;
}
progress::-webkit-progress-value {
  background-color: #0bcc6c;
  transition: all 0.5s ease-in-out;
}
.form-progress-indicator {
  position: absolute;
  top: -3px;
  left: 0;
  display: inline-block;
  width: 20px;
  height: 20px;
  background: white;
  border: 3px solid #ddd;
  border-radius: 50%;
  transition: all 0.2s ease-in-out;
  transition-delay: 0.3s;
  will-change: transform;
}
.form-progress-indicator.one {
  left: 0;
}
.form-progress-indicator.two {
  left: 33%;
}
.form-progress-indicator.three {
  left: 66%;
}
.form-progress-indicator.four {
  left: 100%;
}
.form-progress-indicator.active {
  animation: bounce 0.5s forwards;
  animation-delay: 0.5s;
  border-color: #0bcc6c;
}
.animation-container {
  position: relative;
  width: 100%;
  transition: 0.3s;
  will-change: padding;
  overflow: hidden;
}
.form-step {
  position: absolute;
  width: 100%;
  transition: 1s ease-in-out;
  transition-timing-function: ease-in-out;
  will-change: transform, opacity;
  background:#fff;
}
.form-step.leaving {
  animation: left-and-out 0.5s forwards;
}
.form-step.waiting {
  transform: translateX(400px);
}
.form-step.coming {
  animation: right-and-in 0.5s forwards;
}
@keyframes left-and-out {
  100% {
    opacity: 0;
    transform: translateX(-400px);
  }
}
@keyframes right-and-in {
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}
@keyframes bounce {
  50% {
    transform: scale(1.5);
  }
  100% {
    transform: scale(1);
  }
}
.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  border: 0;
}
.hidden {
  display: none;
}
.btn-sm, .btn-group-sm > .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}
.btn-secondary {
    color: #fff;
    background-color: #858796;
    border-color: #858796;
}
input[type="text"]
{
  border-bottom:1px solid #444;
}
</style>
<script>
var $body = $('body');
var $progressBar = $('progress');
var $animContainer = $('.animation-container');
var value = 0;
var transitionEnd = 'webkitTransitionEnd transitionend';

/**
 * Resets the form back to the default state.
 * ==========================================
 */
function formReset() {
	value = 0;
	$progressBar.val(value);
	$('.js-form-step').removeClass('left leaving');
	$('.js-form-step').not('.js-form-step[data-step="1"]').addClass('hidden waiting');
	$('.js-form-step[data-step="1"]').removeClass('hidden');
	$('.form-progress-indicator').not('.one').removeClass('active');
	
	$animContainer.css({
		'paddingBottom': $('.js-form-step[data-step="1"]').height() + 'px'
	});
	
	console.warn('Form reset.');
	return false;
}

/**
 * Sets up the click handlers on the form. Next/reset.
 * ===================================================
 */
function setupClickHandlers() {

	// Show next form on continue click
	$('.next1').on('click', function(event) {
    var cate = $('#category').val();
    var subcategory = $('#subcategory').val();
    var name = $('#name').val();
    var price = $('#price').val();
    var pripic = $('#pripic').val();
    if(cate=='')
    {
      $('#category').css('border-color','red');
    }
    else
    {
      $('#category').css('border-color','lightgrey');
    }
    if(subcategory=='')
    {
      $('#subcategory').css('border-color','red');
    }
    else
    {
      $('#subcategory').css('border-color','lightgrey');
    }
    if(name=='')
    {
      $('#name').css('border-bottom','1px solid red');
    }
    else
    {
      $('#name').css('border-bottom','1px solid #444');
    }
    if((price=='')||(price==0))
    {
      $('#price').css('border-bottom','1px solid red');
    }
    else
    {
      $('#price').css('border-bottom','1px solid #444');
    }
    if(pripic=='')
    {
      $('.pripic').css('border-color','red');
    }
    else
    {
      $('.pripic').css('border-color','#0bcc6c');
    }
    if((cate!='')&&(subcategory!='')&&(name!='')&&((price!='')||(price!=0))&&(pripic!=''))
    {
      var $currentForm = $(this).parents('.js-form-step');
			showNextForm($currentForm);
    }
	});
  $('.next2').on('click', function(event) {
    var desc = $('#statusbar_txtEditor .label:nth-child(2)').html();
    var count = desc.substring(13);
    if(count<300)
    {
      alert('Please type aleast 300 characters.');
    }
    else
    {
			var $currentForm = $(this).parents('.js-form-step');
			showNextForm($currentForm);
    }
	});
  $('.next3').on('click', function(event) {
    var error=0;
    $('.required').each(function()
    { 
      if($(this).val()=='')
      {
        $(this).css('border-color','red');
        error++;
      }
      else
      {
        $(this).css('border-bottom','1px solid #444');
      }
    });
    if(error==0)
    {
			var $currentForm = $(this).parents('.js-form-step');
			showNextForm($currentForm);
    }
	});
    $('.back').on('click', function(event) {
			var $currentForm = $(this).parents('.js-form-step');
			showPreForm($currentForm);
	});

	// Reset form on reset button click
	$('.js-reset').on('click', function() {
		formReset();
	});
	
	return false;
}

/**
 * Shows the next form.
 * @param - Node - The current form.
 * ======================================
 */
function showNextForm($currentForm) {
	var currentFormStep = parseInt($currentForm.attr('data-step')) || false;
	var $nextForm = $('.js-form-step[data-step="' + (currentFormStep + 1) + '"]');

	console.log('Current step is ' + currentFormStep);
	console.log('The next form is # ' + $nextForm.attr('data-step'));

	$body.addClass('freeze');

	// Ensure top of form is in view
	$('html, body').animate({
		scrollTop : $progressBar.offset().top
	}, 'fast');

	// Hide current form fields
	$currentForm.addClass('leaving');
	setTimeout(function() {
		$currentForm.addClass('hidden');
	}, 500);
	
	// Animate container to height of form
	$animContainer.css({
		'paddingBottom' : $nextForm.height() + 'px'
	});  

	// Show next form fields
	$nextForm.removeClass('hidden')
					 .addClass('coming')
					 .one(transitionEnd, function() {
						 $nextForm.removeClass('coming waiting');
					 });

	// Increment value (based on 4 steps 0 - 100)
	value += 33;

	// Reset if we've reached the end
	if (value >= 100) {
		formReset();
	} else {
		$('.form-progress')
			.find('.form-progress-indicator.active')
			.next('.form-progress-indicator')
			.addClass('active');

		// Set progress bar to the next value
		$progressBar.val(value);
	}

	// Update hidden progress descriptor (for a11y)
	$('.js-form-progress-completion').html($progressBar.val() + '% complete');

	$body.removeClass('freeze');

	return false;
}

/**
 * Sets up and handles the float labels on the inputs.
 =====================================================
 */
function setupFloatLabels() {
	// Check the inputs to see if we should keep the label floating or not
	$('form input').not('button').on('blur', function() {

		// Different validation for different inputs
		switch (this.tagName) {
			case 'SELECT':
				if (this.value > 0) {
					this.className = 'hasInput';
				} else {
					this.className = '';
				}
				break;

			case 'INPUT':
				if (this.value !== '') {
					this.className = 'hasInput';
				} else {
					this.className = '';
				}
				break;

			default:
				break;
		}
	});
	
	return false;
}

function showPreForm($currentForm) {
	var currentFormStep = parseInt($currentForm.attr('data-step')) || false;
	var $PreForm = $('.js-form-step[data-step="' + (currentFormStep - 1) + '"]');

	console.log('Current step is ' + currentFormStep);
	console.log('The next form is # ' + $PreForm.attr('data-step'));

	$body.addClass('freeze');

	// Ensure top of form is in view
	$('html, body').animate({
		scrollTop : $progressBar.offset().top
	}, 'fast');

	// Hide current form fields
    $PreForm.removeClass('leaving');
	$currentForm.addClass('waiting');
	setTimeout(function() {
        $currentForm.addClass('hidden');
        $PreForm.removeClass('hidden');
        $PreForm.css({"-webkit-animation-name":"fadeInLeft","-moz-animation-name":"fadeInLeft","-o-animation-name":"fadeInLeft", "animation-name": "fadeInLeft","-webkit-animation-fill-mode": "both","-moz-animation-fill-mode": "both","-o-animation-fill-mode": "both","animation-fill-mode": "both","-webkit-animation-duration":".1s","-moz-animation-duration": ".1s","-o-animation-duration": ".1s","animation-duration": ".1s","-webkit-animation-delay": ".1s","-moz-animation-delay": ".1s","-o-animation-duration":".1s","animation-delay": ".1s"});
        setTimeout(() => {
            $PreForm.removeAttr('style');
        }, 300);
	}, 500);
	
	// Animate container to height of form
	$animContainer.css({
		'paddingBottom' : $PreForm.height() + 'px'
	});  

	// Show next form fields


	// Increment value (based on 4 steps 0 - 100)
	value -= 33;

	// Reset if we've reached the end
	if (value >= 100) {
		formReset();
        console.log('form reset');
	} else {
		// $('.form-progress')
		// 	.find('.form-progress-indicator.active')
		// 	.next('.form-progress-indicator ')
		// 	.addClass('active');
        $('.form-progress-indicator.active:last').removeClass('active');
		// Set progress bar to the next value
		$progressBar.val(value);
	}

	// Update hidden progress descriptor (for a11y)
	$('.js-form-progress-completion').html($progressBar.val() + '% complete');

	$body.removeClass('freeze');

	return false;
}

/**
 * Gets the party started.
 * =======================
 */
function init() {
	formReset();
	setupFloatLabels();
	setupClickHandlers();
}
init();

$('.pic').click(function(){
  $('#pic').trigger('click');
});
$('.pripic').click(function(){
  $('#pripic').trigger('click');
});

$('#pic').change(function(){
  var count = $(this)[0].files;
  if(count.length>0)
  {
    $('#labelother').text('(Selected '+count.length+' File)');
  }
  else
  {
    $('#labelother').text('');
  }
});
$('#pripic').change(function(){
  var count = $(this)[0].files;
  if(count.length>0)
  {
    $('#labelpri').text('(Selected '+count.length+' File)');
  }
  else
  {
    $('#labelpri').text('');
  }
});

$('input').change(function() {
  $(this).next('label').text($(this).val());
})

$('#category').change(function(){
  var cate_id = $(this).val();
  $.ajax({
      type: "Get",
      contentType: "application/json",
      url: "/get_subcate/"+cate_id,
      success: function (result) {
        var data = $.parseJSON(result)
        $('#subcategory').html(data['subcategory']);
        $('#specificatio_feilds').html(data['specification']);
        $('#subcategory').removeAttr('readonly');
        $('#subcategory').removeAttr('disabled');
      }
  });
});
$('.numbers').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});

// $(document).ready(function() {
//   $(window).keydown(function(event){
//     if(event.keyCode == 13) {
//       event.preventDefault();
//       return false;
//     }
//   });
// });
</script>
@endsection