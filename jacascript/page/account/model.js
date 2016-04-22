function User(data){
    this.id = data.id;
    
    this.name = data.name!=null?data.name:null;
    this.email = data.email!=null?data.email:null;
    this.last_login = data.last_login!=null?data.last_login:null;
    this.create_date = data.create_date!=null?data.create_date:null;
    this.online = data.online!=null?data.online:null;
    this.image = data.image!=null?data.image:null;
    this.groups = data.groups!=null?data.groups:[];
    this.user_permissions = data.user_permissions!=null?data.user_permissions:[];
}