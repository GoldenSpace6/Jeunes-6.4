function caseMax(checkbox) {
    var checkboxes = document.querySelectorAll('.liste_checkbox input[type="checkbox"]:checked');
    if (checkboxes.length > 4) {
      checkbox.checked = false;
    }
  }