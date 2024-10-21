let pasword = document.getElementById('parol'),
test_pasword = document.getElementById('parol_test'),
btn = document.querySelector('.login_btn')

test_pasword.addEventListener('keyup',function(e){
    if(e.target.value == pasword.value){
        test_pasword.style.borderColor = ''
        test_pasword.style.boxShadow ='0 0 5px 2px #0dcaf0'
        btn.removeAttribute('disabled')
    }else{
        test_pasword.style.boxShadow ='0 0 5px 2px rgba(255, 0, 0, 0.5)'
        test_pasword.style.borderColor = 'red'
        btn.setAttribute('disabled', 'true');
    }
})