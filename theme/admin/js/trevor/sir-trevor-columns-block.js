/*! sir-trevor-columns-block 2015-03-01 */
/* global define:true module:true window: true */
(function(global, factory) {
    if (typeof define === 'function' && define['amd']) {
        define(['sir-trevor-js', 'jquery'], factory);
    } else if (typeof module !== 'undefined' && module['exports']) {
        var SirTrevor = require('sir-trevor-js');
        var jQuery = require('jquery');
        module['exports'] = factory(SirTrevor, jQuery);
    } else if (typeof this !== 'undefined') {
        global.SirTrevor.Blocks.Columns = factory(global.SirTrevor, global.jQuery);
    }
})(typeof window !== 'undefined' ? window : this, function factory(SirTrevor, $) {
    "use strict";
    /*
     Columns Layout Block
     */
    return SirTrevor.Blocks.Columns = SirTrevor.Block.extend({

        type: "Columns",

        title: function () {
            return i18n.t('blocks:columns:title') || 'Columns';
        },

        icon_name: 'columns',

        columns_presets: {
            'columns-6-6': [6, 6],
            'columns-3-9': [3, 9],
            'columns-9-3': [9, 3],
            'columns-4-8': [4, 8],
            'columns-8-4': [8, 4],
            'columns-4-4-4': [4, 4, 4],
            'columns-3-6-3': [3, 6, 3],
            'columns-3-3-3-3': [3, 3, 3, 3]
        },

        controllable: true,

        constructor: function (data, editorInstance, mediator, options) {
            SirTrevor.Block.apply(this, arguments);
        },

        beforeBlockRender: function () {
            this.controls = {
                'twocolumns': this.changeColumnsHandler('columns-6-6'),
                'threecolumns': this.changeColumnsHandler('columns-4-4-4'),
                'onetwocolumns': this.changeColumnsHandler('columns-4-8'),
                'twoonecolumns': this.changeColumnsHandler('columns-8-4'),
                'fourcolumns': this.changeColumnsHandler('columns-3-3-3-3'),
                'onethreecolumns': this.changeColumnsHandler('columns-3-9'),
                'threeonecolumns': this.changeColumnsHandler('columns-9-3'),
                'onetwoonecolumns': this.changeColumnsHandler('columns-3-6-3')
            };
        },

        changeColumnsHandler: function (preset) {
            var self = this;
            return function () {
                self.changeColumns(preset, false);
            };
        },

        changeColumns: function (preset) {
            if (this.columns_preset !== preset) {
                this.applyColumns(preset);
            }
        },

        editorHTML: function () {
            return '<div class="columns-row" id="#{blockID}-columns-row" style="overflow: auto"/>'.replace('#{blockID}', this.blockID);
        },

        _setBlockInner: function () {
            SirTrevor.Block.prototype._setBlockInner.apply(this, arguments);
            this.applyColumns('columns-6-6', true);
            /* default */
        },

        applyColumns: function (preset, initial) {
            var self = this;
            var columns_config = this.columns_presets[preset];

            var $to_delete = this.getColumns(':gt(' + (columns_config.length - 1) + ')');
            // if there are unneeded columns
            if ($to_delete.length > 0) {
                // ask confirmation only if there are nested blocks
                if ($to_delete.children('.st-block').length > 0) {
                    var txt = $to_delete.length === 1 ? 'column' : ($to_delete.length + ' columns');
                    if (!window.confirm('This action will delete last ' + txt + '. Do you really want to proceed?')) {
                        return; // interrupt if "Cancel" is pressed
                    }
                }
                $to_delete.each(function () {
                    var $this = $(this);
                    // destroy nested blocks properly
                    $this.children('.st-block').each(function () {
                        self.editorInstance.block_manager.removeBlock(this.getAttribute('id'));
                    });
                    // destroy column itself
                    $this.trigger('destroy').remove();
                });
            }

            // apply new configuration
            var total_width = columns_config.reduce(function (total, width) {
                return total + width;
            }, 0);
            var $row = this.$('.columns-row');

            columns_config.forEach(function (ratio, i) {
                var width = Math.round(ratio * 1000 * 100 / total_width) / 1000;

                var $column = self.getColumn(i);
                if ($column.length === 0) {
                    $column = $('<div class="column" style="float: left;"></div>');
                    var plus = new SirTrevor.FloatingBlockControls($column, self.instanceID, self.mediator);
                    // self.listenTo(plus, 'showBlockControls', self.editorInstance.showBlockControls);
                    $column.prepend(plus.render().$el);
                    $row.append($column);
                }

                $column.css('width', width + '%');
            });

            this.$('.st-block-control-ui-btn').removeClass('active')
                .filter('[data-icon=' + preset + ']').addClass('active');

            this.columns_preset = preset;

            if (!initial) {
                this.trigger('block:columns:change');
            }
        },

        onBlockRender: function () {
            this.$('.st-block-control-ui-btn').filter('[data-icon=' + this.columns_preset + ']').addClass('active');
        },

        getRow: function () {
            if (this.$row) {
                return this.$row;
            }
            this.$row = this.$('#' + this.blockID + '-columns-row');
            return this.$row;
        },

        getColumns: function (filter) {
            return this.getRow().children(filter);
        },

        getColumn: function (index) {
            return this.getRow().children(':eq(' + index + ')');
        },

        _serializeData: function () {
            var self = this;
            var column_config = this.columns_presets[this.columns_preset];
            var dataObj = {columns: [], preset: this.columns_preset};

            this.getColumns().each(function (i) {
                var blocksData = [];
                $(this).children('.st-block').each(function () {
                    var block = self.editorInstance.findBlockById(this.getAttribute('id'));
                    blocksData.push(block.getData());
                });

                dataObj.columns.push({
                    width: column_config[i],
                    blocks: blocksData
                });
            });

            return dataObj;
        },

        loadData: function (data) {
            if (data.preset) {
                this.applyColumns(data.preset, true);
            }

            var columns_data = (data.columns || []);
            for (var i = 0; i < columns_data.length; i++) {
                var $block = null;
                var $column = this.getColumn(i);
                for (var j = 0; j < columns_data[i].blocks.length; j++) {
                    var block = columns_data[i].blocks[j];
                    $block = this.editorInstance.block_manager.createBlock(block.type, block.data, $block ? $block.$el : $column.children('.st-block-controls__top'));
                }
            }
        },

        performValidations: function () {
            // nothing
        }
    });
});
