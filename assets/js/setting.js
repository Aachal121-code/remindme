// Simple helpers for settings pages
document.addEventListener('DOMContentLoaded', () => {
    // File input preview (profile avatar)
    const avatarInput = document.querySelector('input[name="avatar"]');
    if (avatarInput) {
        avatarInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = () => {
                const imgBox = document.querySelector('.card img');
                if (imgBox) imgBox.src = reader.result;
            };
            reader.readAsDataURL(file);
        });
    }



    // Edit profile toggle
    const editBtn = document.querySelector('.edit-profile-btn');
    const cancelBtn = document.querySelector('.cancel-edit-btn');
    const profileView = document.querySelector('.profile-view');
    const profileForm = document.querySelector('.profile-edit-form');
    if (editBtn) {
        editBtn.addEventListener('click', () => {
            if (profileView) profileView.style.display = 'none';
            if (profileForm) profileForm.style.display = 'block';
            window.scrollTo({ top: profileForm.offsetTop - 20, behavior: 'smooth' });
        });
    }
    if (cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            if (profileForm) profileForm.style.display = 'none';
            if (profileView) profileView.style.display = 'block';
        });
    }

});