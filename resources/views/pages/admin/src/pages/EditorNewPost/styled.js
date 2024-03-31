import styled from 'styled-components';
import ReactQuill from 'react-quill';

export const EditorNewPostContainer = styled.div``;

export const EditorNewPostContent = styled.div`
  form {
    padding: 1rem;

    display: flex;
    flex-direction: column;
    gap: 1rem;
  }
`;

export const EditorNewPostFormGroup = styled.div`
  input {
    font-size: 0.9rem;
    height: 40px;
  }
`;

export const EditorQuill = styled(ReactQuill)`
  min-height: 600px;
  width: 100%;

  .ql-container,
  .ql-editor {
    min-height: 600px !important;
  }
`;
