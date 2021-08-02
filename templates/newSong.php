<h2>Neuen Song hinzufügen</h2>
<form action="?controller=newSong&function=addNewSong" method="post" enctype="multipart/form-data"
      class="needs-validation">
    <div class="form-group">
        <label for="name">Songnames:</label>
        <input class="form-control" type="text" required="true" placeholder="Songname eingeben" name="name"/>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
        <label for="name">Album:</label>
        <input class="form-control" type="text" required="true" placeholder="Albumname eingeben" name="album"/>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
        <label for="name">Interpret:</label>
        <input class="form-control" type="text" required="true" placeholder="Interpretenname eingeben"
               name="interpret"/>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
        <label for="name">Genre:</label>
        <input class="form-control" type="text" required="true" placeholder="Genre eingeben" name="genre"/>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
        <label for="name">Songfile:</label>
        <div class="custom-file">
            <input class="custom-file-input" id="inputGroupFile03" type="file" accept="audio/*" name="songFile">
            <label class="custom-file-label" for="inputGroupFile03">Choose Songfile</label>
        </div>
    </div>
    <div class="form-group">
        <label for="name">Coverimage:</label>
        <div class="custom-file">
            <input class="custom-file-input" id="inputGroupFile03" type="file" accept="image/*" name="coverImage">
            <label class="custom-file-label" for="inputGroupFile03">Choose CoverImage</label>
        </div>
    </div>
    <p/><input class="form-control" type="submit"/>
</form>
