document.addEventListener('DOMContentLoaded', () => {

    let selectedNumbers = [];
    const numbers = document.querySelectorAll('.number');
    const selectedNumbersInput = document.getElementById('selected_numbers');

    numbers.forEach(number => {
        number.addEventListener('click',() => {
        const num = parseInt(number.getAttribute('data-number'));
        
        if (selectedNumbers.includes(num)){
            selectedNumbers = selectedNumbers.filter(n => n !== num);
            number.classList.remove('bg-green-300');
        }else if (selectedNumbers.length < 5){
            selectedNumbers.push(num);
            number.classList.add('bg-red-300');
        }     

        selectedNumbersInput.value = JSON.stringify(selectedNumbers);
    
        })
    })

});  