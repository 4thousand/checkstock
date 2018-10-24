<template>
    <div class="container">
      <md-card class="md-layout-item md-size-50 md-small-size-100">
        <md-card-header>
          <div style="display:inline:block" class="md-title">Setting</div>  <md-icon>settings</md-icon>
        </md-card-header>
          <md-card-content>
          <div class="md-layout md-gutter">
            <div class="md-layout-item md-small-size-100">
              <md-field >
                <label for="first-name">First Name</label>
                <md-input name="first-name" id="first-name"  />
                <span class="md-error" >The first name is required</span>
                <span class="md-error">Invalid first name</span>
              </md-field>
            </div>
          </div>
          </md-card-content>
            <md-card-actions>
          <md-button type="submit" class="md-primary" >Create user</md-button>
        </md-card-actions>
            <md-snackbar>The user  was saved with success!</md-snackbar>
      </md-card>
      </div>
</template>
<script src="../js/setting.js"></script>
<style></style>