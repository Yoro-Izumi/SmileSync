document.addEventListener('DOMContentLoaded', async () => {
  const provinceSelect = document.getElementById('province');
  const citySelect = document.getElementById('city');
  const barangaySelect = document.getElementById('barangay');

  let citiesData = {};
  let barangaysData = {}; 

  // Load all data
  const provinces = await fetch('address_json/provinces.json').then(res => res.json());
  citiesData = await fetch('address_json/cities.json').then(res => res.json());
  barangaysData = await fetch('address_json/barangays.json').then(res => res.json());

  // Populate provinces
  provinces.forEach(province => {
    provinceSelect.appendChild(new Option(province, province));
  });

  provinceSelect.addEventListener('change', function () {
    const selectedProvince = this.value;
    const cities = citiesData[selectedProvince] || [];

    // Reset cities and barangays
    citySelect.innerHTML = '<option value="" disabled selected>Select City/Municipality</option>';
    barangaySelect.innerHTML = '<option value="" disabled selected>Select Barangay</option>';
    citySelect.disabled = cities.length === 0;
    barangaySelect.disabled = true;

    cities.forEach(city => {
      citySelect.appendChild(new Option(city, city));
    });
  });

  citySelect.addEventListener('change', function () {
    const selectedProvince = provinceSelect.value;
    const selectedCity = this.value;
    const barangays = (barangaysData[selectedProvince] && barangaysData[selectedProvince][selectedCity]) || [];

    // Reset barangays
    barangaySelect.innerHTML = '<option value="" disabled selected>Select Barangay</option>';
    barangaySelect.disabled = barangays.length === 0;

    barangays.forEach(brgy => {
      barangaySelect.appendChild(new Option(brgy, brgy));
    });
  });
});
