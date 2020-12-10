import React from 'react';
import ReactDOM from 'react-dom';
import AlertBox from '../components/widgets/AlertBox';

var self = {
    lang: $('html').attr('lang')
}

if($('.delete-alert-onclick').html()){
    $('.delete-alert-onclick').find('button').on('click',function (e){
        ReactDOM.render(<AlertBox/>, document.getElementById('white-alert-box'))
        e.preventDefault()

        $('#alert-cancel, #alert-close').on('click', ()=>{
            ReactDOM.render('', document.getElementById('white-alert-box'))
        })

        $('#alert-pass').on('click', ()=>{
            let actionURL = $('#'+this.id).parents('form').attr('action')
            $.ajax({
                url: actionURL,
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') }
            })

            location.reload()
        })

    });
}

if (document.getElementById('allow_pass_change')){
    let checkBtn = $('#allow_pass_change');
    let passwordInp = $('#user-password-access');

    checkBtn.change(function (){
        if(checkBtn.prop('checked')){
            passwordInp.attr('disabled',false)
        }else{
            passwordInp.attr('disabled',true)
        }
    })
}

if(document.getElementById('hide-page')) {
    $('.btn-group').find('a[hideable=1]').on('click',function(e) {
        e.preventDefault()
        let actionValue = $(this).attr('vis')
        $.ajax({
            url: this.href,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              'action': actionValue
            },
            success: function (res) {
                console.log(res)
            }
        })
        let eyeIcon = $(this).find('i')
        if (actionValue == 1){
            eyeIcon.replaceWith("<i class=\"fas fa-eye\"></i>")
            $(this).attr('vis', 0)
        }else{
            eyeIcon.replaceWith("<i class=\"fas fa-eye-slash\"></i>")
            $(this).attr('vis', 1)
        }
    })
}

if(document.getElementById("have_image")) {
    let checkbox = $('#have_image');
    let imageInput = $('#thumbnail');

    if(imageInput.val()) {
        checkbox.prop('checked', true);
    }

    imageInput.on('change', function () {
        checkbox.prop('checked', true)
        $('#thumbnail').prop('disabled', false)
    })

    checkbox.on('change',function() {
       if ($(this).is(':checked')) {
           $('#thumbnail').prop('disabled', false)
       }else{
           $('#thumbnail').prop('disabled', true)
       }
    });
}
