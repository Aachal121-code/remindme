document.addEventListener('DOMContentLoaded', () => {
    const avatarInput = document.querySelector('input[name="avatar"]');
    if (avatarInput) {
        avatarInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file || !file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = () => {
                const imgBox = document.querySelector('.card img');
                if (imgBox) imgBox.src = reader.result;
            };
            reader.readAsDataURL(file);
        });
    }

    const editBtn = document.querySelector('.edit-profile-btn');
    const cancelBtn = document.querySelector('.cancel-edit-btn');
    const profileView = document.querySelector('.profile-view');
    const profileForm = document.querySelector('.profile-edit-form');

    if (editBtn) {
        editBtn.addEventListener('click', () => {
            profileView?.style && (profileView.style.display = 'none');
            profileForm?.style && (profileForm.style.display = 'block');
            window.scrollTo({ top: profileForm.offsetTop - 20, behavior: 'smooth' });
        });
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            profileForm?.style && (profileForm.style.display = 'none');
            profileView?.style && (profileView.style.display = 'block');
        });
    }
});
