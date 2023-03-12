<template>
  <div>
    <FullCalendar :options="calendarOptions" />
  </div>
</template>

<script>
import "@fullcalendar/core/vdom"; // solve problem with Vite
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import resourceTimelinePlugin from "@fullcalendar/resource-timeline";
import axios from "axios";
import { Inertia } from "@inertiajs/inertia";
import moment from "moment";

export default {
  components: {
    FullCalendar,
  },
  data() {
    return {
      calendarOptions: {
        plugins: [
          dayGridPlugin,
          timeGridPlugin,
          interactionPlugin, // needed for dateClick
          resourceTimelinePlugin,
        ],
        buttonText : {
          resourceTimeline :'jour',
          dayGridMonth : 'Mois',
          resourceTimelineWeek : 'Semaine',
        },
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,resourceTimelineWeek,resourceTimeline",
          
        },

        height: "auto",
        initialView: "dayGridMonth",
        selectable: true,
        selectMirror: true,
        editable: true,
        select: this.handleDateClick,
        eventClick: this.handleEventClick,
        eventDrop: this.handledrop,
        eventResize: this.handleresize,
        slotMinTime: "07:00:00",
        slotMaxTime: "20:00:00",
        schedulerLicenseKey: "CC-Attribution-NonCommercial-NoDerivatives",
      },
    };
  },
  beforeMount() {
    (this.$data.calendarOptions.events = {
      url: route("interventions.json"),
      method: "GET",
    }),
      (this.$data.calendarOptions.resources = {
        url: route("Technicien.index"),
        method: "GET",
      });
  },

  methods: {
    handleresize(info) {
       if(info.newResource !== null){
      

      Inertia.get(route("Intervention.updatecalendar"), {
        intervention_id: info.event.id,
        date_debut: this.dateTime(info.event.start),
        date_fin: this.dateTime(info.event.end),
        technicien_id : info.newResource.id,
      });
      };
    if(  info.newResource == null){  

      Inertia.get(route("Intervention.updatedates"), {
        intervention_id: info.event.id,
        date_debut: this.dateTime(info.event.start),
        date_fin: this.dateTime(info.event.end),
       
      });
    }
    },

    dateTime(value) {
      return moment(value).format("YYYY-MM-DD HH:MM:SS");
    },

    handledrop(info) {
     if( info.oldResource !== null){
      console.log( typeof info.newResource);

      Inertia.get(route("Intervention.updatecalendar"), {
        intervention_id: info.event.id,
        date_debut: this.dateTime(info.event.start),
        date_fin: this.dateTime(info.event.end),
        technicien_id : info.newResource.id,
      });
      };
    if(  info.oldResource == null){  
      
      Inertia.get(route("Intervention.updatedates"), {
        intervention_id: info.event.id,
        date_debut: this.dateTime(info.event.start),
        date_fin: this.dateTime(info.event.end),
       
      });
    }
    },
    handleEventClick(clickInfo) {
      if (
        confirm(
          `Are you sure you want to delete the event '${clickInfo.event.title}'`
        )
      ) {
        axios.delete(`../interventions/${clickInfo.event.id}`);

        clickInfo.event.remove();
      }
    },

    handleDateClick(click) {
      this.$emit("dateClick", click);
    },
  },
};
</script>

<style>
</style>