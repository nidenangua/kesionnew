const teacherAnswerRouters = [
   /**答疑回复*/
    {
      path: '/answeradd',
      name: 'TeacherAnswerAdd',
      component: resolve => {
        require(['@/pages/teacher-answer/TeacherAnswerAdd.vue'], resolve)
      }
    }
]
export default teacherAnswerRouters