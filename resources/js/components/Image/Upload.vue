<template>
    <div >
        <div id="preview" class="mb-2" >
            <img class="w-100" v-if="item.imageUrl" :src="item.imageUrl" />
        </div>
         <b-form-file
            v-model="file"
            :state="Boolean(file)"
            placeholder="Choose a file or drop it here..."
            drop-placeholder="Drop file here..."
            accept="image/*" @change="onChange"
        ></b-form-file>
    </div>
</template>


<script>
export default {
  name: 'imageUpload',
  props: ['action'],
  data() {
    return {
        item:{
          //...
          image : null,
          imageUrl: null
      }
    }
  },
  methods: {
    onChange(e) {
      const file = e.target.files[0];
      this.image = file;
      this.item.imageUrl = URL.createObjectURL(file);
      this.uploadImage(e);
    },
    uploadImage(event) {

        const URL = this.action;

        let data = new FormData();
        data.append('name', 'avatar');
        data.append('file', event.target.files[0]);

        let config = {
            header : {
                'Content-Type' : 'image/png'
            }
        };

        axios.put(
                URL,
                data,
                config
            ).then(
            response => {
                console.log('image upload response > ', response)
            }
        );
    }
  }
}
</script>
