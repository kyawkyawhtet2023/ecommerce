document.addEventListener('DOMContentLoaded', function () {

    
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const image = this.getAttribute('data-image');

           
            const editId = document.getElementById('edit-id');
            const editName = document.getElementById('edit-name');
            const editPreview = document.getElementById('edit-preview');

            if (editId && editName && editPreview) {
                editId.value = id;         
                editName.value = name;     
                editPreview.src = image;   
            }

            
            document.querySelector('.edit-container').style.display = 'block';
        });
    });

    
    const editForm = document.getElementById('editCategoryForm');
    if (editForm) {
        editForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const id = document.getElementById('edit-id').value;  
            const formData = new FormData(this); 

            const updateButton = document.getElementById('update-category-btn');
            updateButton.textContent = 'Loading...'; 
            updateButton.disabled = true;

            fetch(`/categories/${id}`, {
                method: 'POST',  
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    
                    const row = document.getElementById(`edit-${id}`).closest('tr');
                    if (row) {
                        row.querySelector('td:nth-child(3)').textContent = data.category.name;  
                        row.querySelector('img').src = data.category.image_url; 
                    }

                    
                    document.querySelector('.edit-container').style.display = 'none';
                    editForm.reset();

                   
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    alert('Error updating category: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the category.');
            })
            .finally(() => {
                updateButton.textContent = 'Update Category'; 
                updateButton.disabled = false;
            });
        });
    }

   
    const cancelBtn = document.getElementById('cancel-edit');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function () {
            document.querySelector('.edit-container').style.display = 'none';  
            editForm.reset();  
        });
    }

});


document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-category-form').forEach(form => {
        const categoryId = form.getAttribute('data-id');
        const deleteButton = document.getElementById('delete-btn-' + categoryId);

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            
                deleteButton.textContent = 'Deleting...';  
                deleteButton.disabled = true;  

                
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: new FormData(form)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to delete the category.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        window.location.reload();  
                    } else {
                        alert('Failed to delete category: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the category.');
                    deleteButton.textContent = 'Delete';  
                    deleteButton.disabled = false; 
                });
            
        });
    });
});

