
<div class="w3-container">
  <h2>CREATE BATCH</h2>
  <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-green w3-large">Create</button>

  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        <img src="img_avatar4.png" alt="LOGO" style="width:30%" class="w3-circle w3-margin-top">
      </div>

      <form class="w3-container" action="batch.blade.php">
        <div class="w3-section">
          <label><b>Farmer School Name</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Philippine Farm School" name="school_name" id="school_name" required>
          <label><b>Assigned Site</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Philippine Farm School" name="site" id="site" required>
          <label><b>Number of Seedlings Distributed</b></label>
          <input class="w3-input w3-border" type="text" placeholder="300" name="seedlings" id="seedlings" required>
          <label><b>Farmer's Name</b></label>
          <input class="w3-input w3-border" type="text" placeholder="John Doe" name="farmer_name" id="farmer_name" required>
          <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Create</button>
          <!---<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="add_batch">Create</button>-->
         
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
      
      </div>

    </div>
  </div>
</div>