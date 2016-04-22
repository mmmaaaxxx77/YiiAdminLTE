function User(data){
    this.user = data.username!=null?data.user:null;
    this.email = data.email!=null?data.email:null;
}

function Group(data){
    this.name = data.name!=null?data.name:null;
}