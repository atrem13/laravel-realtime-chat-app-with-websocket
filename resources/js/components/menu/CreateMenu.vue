<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-primary" v-if="success">
                    {{success}}
                </div>
                <div v-if="errors">
                    <div class="alert alert-danger" v-for="(error, i) in errors" :key="i">{{error}}</div>
                </div>
                <div class="card">
                    <div class="card-body table-responsive">
                        <form @submit.prevent="addMenu">
                            <input type="text" placeholder="Nama..." v-model="newMenu.nama" class="form-control">
                            <input type="text" placeholder="Deskripsi..." v-model="newMenu.deskripsi" class="form-control">
                            <input type="text" placeholder="Harga..." v-model="newMenu.harga" class="form-control">
                            <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'create-menu',
    created(){
    },
    data(){
        return{
            newMenu: {
                nama: '',
                deskripsi: '',
                harga: ''
            },
            errors: [],
            success: ''
        }
    },
    methods:{
        addMenu(event){
            // console.log(this.newMenu);
            axios.post('/menu', this.newMenu).then(response => {
                console.log(response);
                if(response.data.result == 'fail'){
                    this.errors = response.data.data;
                }else if(response.data.result == 'success'){
                    this.success = 'data menu berhasil ditambahkan';
                    this.newMenu.nama = '';
                    this.newMenu.deskripsi = '';
                    this.newMenu.harga = '';
                    event.target.reset();
                }else{

                }
            });
        }
    }
}
</script>
