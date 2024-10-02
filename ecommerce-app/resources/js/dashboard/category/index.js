document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('create').addEventListener('click', function () {
        
        document.querySelector('.container-create').style.display = 'block'; 
        
    });
    const cancelCreate = document.getElementById('cancel-create');
    if (cancelCreate) {
        cancelCreate.addEventListener('click', function (){
            document.querySelector ('.container-create').style.display = 'none';
            
        });
    }
    
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

                    
                    location.reload();
                } else {
                    
                    alert('Error updating category: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the category.');
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

