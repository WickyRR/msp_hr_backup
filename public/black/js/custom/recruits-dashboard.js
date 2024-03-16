$('#exampleModalLong').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var name = button.data('name');
  var index = button.data('index');
  var user_id = button.data('userid');
  var department = button.data('department');
  var faculty = button.data('faculty');
  var msp = button.data('msp');
  var projects = button.data('projects');
  var sports = button.data('sports');
  var clubs = button.data('clubs');
  var achievements = button.data('achievements');
  var email=button.data('email');
  var contact=button.data('contact');
  var level=button.data('level');
  var skills=button.data('skills');
  var pillars=button.data('pillars');
  var status=button.data('status');

    var mem_skills=''
    //console.log(skills[0].skill_name);
    for (i = 0; i < skills.length; i++) {

            //console.log(skills[i].skill_name);
            if(skills[i].recruit_id==user_id){
                mem_skills+=skills[i].skill_name
                mem_skills+=', '
            }

    }
    var member_skills = mem_skills.substr(0,mem_skills.length-2);
   // console.log(user_id,member_skills);


    var mem_pillars=''
    //console.log(skills[0].skill_name);
    for (i = 0; i < pillars.length; i++) {

            //console.log(skills[i].skill_name);
            if(pillars[i].recruit_id==user_id){
                mem_pillars+=pillars[i].pillar_name
                mem_pillars+=', '
            }

    }
    var member_pillars = mem_pillars.substr(0,mem_pillars.length-2);
    //console.log(user_id,member_skills);

  if(msp==0){
    var moraspiriter = "New Member";
  }
  else{
    var moraspiriter = "Old Member";
  }
  if(status==0){
    var mem_status = "Applied";
  }
  else if(status==2){
    var mem_status = "Rejected";
  }
  else{
      var mem_status="Recruited";
  }


   // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  //console.log(recipient)
  modal.find('.text-username').text(name);
  modal.find('.ml-2-name').text(name);
  modal.find('.ml-2-index').text(index);
  modal.find('.ml-2-department').text(department);
  modal.find('.ml-2-email').text(email);
  modal.find('.ml-2-contact').text(contact);
  modal.find('.ml-2-faculty').text(faculty);
  modal.find('.ml-2-level').text(level);
  modal.find('.ml-2-msp').text(moraspiriter);
  modal.find('.ml-2-projects').text(projects);
  modal.find('.ml-2-sports').text(sports);
  modal.find('.ml-2-clubs').text(clubs);
  modal.find('.ml-2-achievments').text(achievements);
  modal.find('.ml-2-skills').text(member_skills);
  modal.find('.ml-2-pillars').text(member_pillars);
  modal.find('.ml-2-status').text(mem_status);


})