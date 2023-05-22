function limitCheckboxSelection(checkbox) {
    var checkboxes = document.querySelectorAll('.liste_checkbox_jeune input[type="checkbox"]:checked');
    if (checkboxes.length > 4) {
      checkbox.checked = false;
    }
  }

  function limitCheckboxSelection(checkbox) {
    var checkboxes = document.querySelectorAll('.liste_checkbox_referent input[type="checkbox"]:checked');
    if (checkboxes.length > 4) {
      checkbox.checked = false;
    }
  }





