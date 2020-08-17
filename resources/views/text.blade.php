<style>
.widget-user-username{
    color:white;
}

</style>
<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info-active" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHQTXIEqI12L2uV6C5UKyjzefq3iHIxvKVTCbu43mo6xqowE9z&s')">
                        <h3 class="widget-user-username">Perth</h3>
                        <h5 class="widget-user-desc"></h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2"   alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
            <!--profile content-->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active show" href="#activity" data-toggle="tab">Activity</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="activity">
                                    <!-- Post -->
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-2 control-label">Name</label>

                                            <div class="col-sm-10">
                                                <input type="text" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{'is-valid':form.errors.has('name')}">
                                                <has-error :form="form" field="name"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                           <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-10">
                                                <input type="email" v-model="form.email" class="form-control" id="inputEmail" :class="{'is-valid':form.errors.has('email')}" placeholder="Email">
                                                <has-error :form="form" field="email"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputExperience" class="col-sm-2 control-label">Password</label>

                                            <div class="col-sm-10">
                                                <input type="password" v-model="form.password" class="form-control" id="inputExperience" placeholder="Experience" :class="{'is-valid':form.errors.has('password')}">
                                                <has-error :form="form" field="password"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-2 control-label">Profile Photo</label>

                                            <div class="col-sm-10">
                                                <input type="file"  @change="updateProfile"  name="photo" class="form-input">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="Bio" class="col-sm-2 control-label">Bio</label>

                                            <div class="col-sm-10">
                                                <input type="text"v-model="form.bio" class="form-control" id="inputbio" placeholder="Bios">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button @click.prevent="updateInfo" type="submit"class="btn btn-outline-success">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
        </div>
    </div>
</template>
<script>
 export default {
        data(){
            return{
                form:new Form({
                    id:'',
                    name:'',
                    email:'',
                    password:'',
                    type:'',
                    bio:'',
                    photo:''
                })
            }
        },
        methods:{
            updateInfo(){
                  this.$Progress.start();
                this.form.put('api/profile/')
                .then(()=>{
                    
                  this.$Progress.finish();  
                })
                .catch(()=>{
                    this.$Progress.fail();

                });
            },
             updateProfile(e){
                    //console.log("updating");
                     let file = e.target.files[0];
                     //console.log(file);
                     let reader = new FileReader();
                     if(file['size'] >1000){
                          //let vm=this;
                         reader.onloadend = (file)=>{
                         //console.log('RESULT',reader.result)
                         this.form.photo=reader.result;
                             }
                        reader.readAsDataURL(file);
                     }else{
                         swal.fire({
                             type: 'error',
                             title: 'Oops...',
                              text: 'You are uploading a large file',
                         })
                        
                     }
                    
             }
             },
        mounted(){
            console.log("profile page");
        },
         created(){
           
        }
 }


</script>