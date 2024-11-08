



document.getElementById('new-category').addEventListener('click', function() {
    const container = document.querySelector('.container-create');
    container.style.display = "block";
});


document.getElementById('cancel-create').addEventListener('click', function() {
    const container = document.querySelector('.container-create');
    container.style.display = "none";
});


document.getElementById('category-btn').addEventListener('click', function() {
    const name = document.getElementById('category-name').value;  
    const imageInput = document.getElementById('create-img');  
    const imageFile = imageInput.files[0];  

   
    const payload = new FormData();
    payload.append('name', name);  
    payload.append('image', imageFile);  

    fetch(categoriesRoute, {  
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        },
        body: payload  
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();  
    })
    .then(data => {
        if (data.success) {
           
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            alert('Failed to add category: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred: ' + JSON.stringify(error));
    });
});
