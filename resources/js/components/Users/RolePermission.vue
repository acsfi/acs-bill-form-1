<style>

.control-permission {
    position:relative;
}
.control-permission .custom-switch {
    min-width: 23%;
}
</style>
<template>
  <div>

       <b-form-checkbox-group
       class="control-permission"
        :disabled="lock"
        switches
        :id="role_id"
        v-model="value"
        :options="options"
        :name="role_id"
        @change="updateSelection"
      ></b-form-checkbox-group>

  </div>
</template>

<script>
  export default {
    mounted(){
        console.log(this);
    },
    props: ['options','values','role_id','lock'],
    data () {
        return {
            value: this.values
        }
    },
    methods:{
        updateSelection(e,l){
             let currentVue = this;
             let data = {
                  value: e,
                  role_id: this.role_id
              };
             axios.post('/api/role/update/' +  this.role_id , data )
              .then(function (response) {
                  currentVue.output = response.data;
              })
              .catch(function (error) {
                  currentVue.output = error;
              });

        }
    }
  }
</script>
