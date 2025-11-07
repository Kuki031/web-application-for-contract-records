'use strict';

import './bootstrap';
import './forms';
import './select2';
import {triggerSearchBar} from './search';
import {toggleHamburgerMenu} from './menu';
import {handleDeleteForms, handlePDFuploadForms, handleCreatePaymentNote, handleUpdatePaymentNote, handleRadioDomains} from './forms';
import { filterForm } from './filterPayments';
import {syncPayments} from './filterSyncPayment';
import { handleMorphNote, handleDeleteMorphNote, handleUpdateMorphNote } from './morphNote';

toggleHamburgerMenu();
triggerSearchBar();
handleDeleteForms();
handlePDFuploadForms();
handleCreatePaymentNote();
handleUpdatePaymentNote();
handleRadioDomains();
handleMorphNote();
handleDeleteMorphNote();
handleUpdateMorphNote();
syncPayments();
