// Select elements
const profilePicInput = document.getElementById('profilePicInput');
const profilePic = document.getElementById('profilePic');

// Add event listener to the file input
profilePicInput.addEventListener('change', function () {
  const file = profilePicInput.files[0];

  if (file) {
    const reader = new FileReader();

    // When file is loaded, update the profile picture
    reader.onload = function (event) {
      profilePic.src = event.target.result;
    };

    // Read the file as a data URL
    reader.readAsDataURL(file);
  }
});
