(function($) {
Drupal.fullcalendar.plugins.fullcalendar_fix = {
  options: function (fullcalendar, settings) {
    return {
      eventRender: function(event, element, view) {
        var dom_id = event.dom_id;
        var entity_type = event.entity_type;
        var entity_id = event.eid;
        var index = event.index;

        var entry = $(dom_id).find(".fullcalendar-event > .fullcalendar-instance > a[eid='" + entity_id + "'][entity_type='" + entity_type + "'][index='" + index + "']");
        var title = entry.parent(".fullcalendar-instance").prev('.title').html();

        element.find('.fc-event-title').html(title);
      }
    };
  }
};
}(jQuery));