/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
import { DisposableStore } from '../../../../base/common/lifecycle.js';
export class OvertypingCapturer {
    constructor(editor, suggestModel) {
        this._disposables = new DisposableStore();
        this._lastOvertyped = [];
        this._empty = true;
        this._disposables.add(editor.onWillType(() => {
            if (!this._empty) {
                return;
            }
            if (!editor.hasModel()) {
                return;
            }
            const selections = editor.getSelections();
            const selectionsLength = selections.length;
            // Check if it will overtype any selections
            let willOvertype = false;
            for (let i = 0; i < selectionsLength; i++) {
                if (!selections[i].isEmpty()) {
                    willOvertype = true;
                    break;
                }
            }
            if (!willOvertype) {
                return;
            }
            this._lastOvertyped = [];
            const model = editor.getModel();
            for (let i = 0; i < selectionsLength; i++) {
                const selection = selections[i];
                // Check for overtyping capturer restrictions
                if (model.getValueLengthInRange(selection) > OvertypingCapturer._maxSelectionLength) {
                    return;
                }
                this._lastOvertyped[i] = { value: model.getValueInRange(selection), multiline: selection.startLineNumber !== selection.endLineNumber };
            }
            this._empty = false;
        }));
        this._disposables.add(suggestModel.onDidCancel(e => {
            if (!this._empty && !e.retrigger) {
                this._empty = true;
            }
        }));
    }
    getLastOvertypedInfo(idx) {
        if (!this._empty && idx >= 0 && idx < this._lastOvertyped.length) {
            return this._lastOvertyped[idx];
        }
        return undefined;
    }
    dispose() {
        this._disposables.dispose();
    }
}
OvertypingCapturer._maxSelectionLength = 51200;
