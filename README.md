![ocws-newsbox](./images/castlelogo80x80.png) ![ocws-newsbox](./images/newsicon_80.png)

# ocws-newsbox
The idea behind this plugin is to create little newsboxes that can be inserted into any page or post. These are particularly useful on the Front Page of a website, enabling the user to change a news announcement, without re-editing the whole page.

## Shortcode
The shortcode should look like this.

[newsbox nbid='172']

## Version 0.2
Some adjustments made to the styling. However, I still cannot get the columns to work.

## Version 0.1
I have got most of the plugin to work. In fact, all the important bits work. The custom post type for the newsboxes works. They are easy to edit. The shortcode works.

But I can't get new columns in the edit list for the newsboxes to appear. This is very frustrating, because I did precisely the same thing for my much more complex Creation caches plugin. But for the newsboxes, the routines that I added to amend the columns won't work. I want a new column for the shortcode, and I want to publish the shortcode for each newsbox, so users can just copy and paste. I can make use of this plugin for myself, but I want others to be able to use it, and I know it needs this column! I used the same functions, filters and hooks with ocws-creationcache, but in this plugin it won't work! Grrrr!

I have started to assume that it must be one of those really small errors that I can't find - like a typo, or just putting the right code in the wrong place.

If anyone out there can look at the code (down near the bottom of the main file) I would be grateful. 