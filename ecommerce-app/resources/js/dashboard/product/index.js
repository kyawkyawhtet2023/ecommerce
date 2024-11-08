
function filterProducts(status) {
    const form = document.getElementById('search-form');
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'status';
    input.value = status;
    form.appendChild(input);
    
    form.submit();
}


function setActiveButton() {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

  
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    
    filterButtons.forEach(button => {
        button.classList.remove('active');
    });

    
    if (status) {
        const activeButton = document.getElementById(status === 'out_of_stock' ? 'out-of-stock' : status);
        if (activeButton) {
            activeButton.classList.add('active');
        }
    } else {
        
        document.getElementById('all-products').classList.add('active');
    }
}


document.addEventListener('DOMContentLoaded', () => {
    setActiveButton();

    
    const filterButtons = document.querySelectorAll('.filter-btn');
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const status = button.id === 'out-of-stock' ? 'out_of_stock' : button.id;
            filterProducts(status);
        });
    });
});





document.addEventListener('DOMContentLoaded', () => {
    const deleteBtn = document.getElementById('delete-btn');
    const deactivateBtn = document.getElementById('deactivate-btn');
    const checkboxes = document.querySelectorAll('input[name="product_ids[]"]');
    const selectAllCheckbox = document.getElementById('select-all');

    function toggleDeleteButton() {
        
        const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        
        deleteBtn.disabled = !anyChecked;
        deactivateBtn.disabled = !anyChecked;

    }

    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleDeleteButton);
    });

    
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('click', function(event) {
            checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
            toggleDeleteButton();
        });
    }

    
    toggleDeleteButton();
});


