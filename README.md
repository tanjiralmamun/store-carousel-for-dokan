# Store Carousel for Dokan
A carousel slider plugin for Dokan to show all stores in a slider. The stores can be filtered by store category in the slider.

### How to use:
- Use `[dokan_store_carousel]` shortcode to any page to show the carousel slider
- The shortcode will show all **Uncategorized** store category contains sellers
- To show any specific categories seller use `category` parameter with the shortcode and put the category name in lowercase within the `""`(quoatation)
- E.g: `[dokan_store_carousel category="clothing"]`
- The shortcode will also display 5 stores by default. To show more stores/vendors, add `limit` parameter within the slider.
- E.g: `[dokan_store_carousel limit="10"]`
- To show any specific store categories any specific number of vendors, use the shortcode as follows: `[dokan_store_carousel category="clothing" limit="10"]`